<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Point of Sale') }}
        </h2>
    </x-slot> --}}

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-6">
                <!-- Products Grid -->
                <div class="w-2/3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <input type="text"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="Search products..." id="searchInput" onkeyup="filterProducts()">
                        </div>
                        <div class="grid grid-cols-3 gap-4" id="productsGrid">
                            @foreach ($products as $product)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition-shadow product-card"
                                    data-name="{{ strtolower($product->name) }}"
                                    data-category="{{ strtolower($product->category->name) }}">
                                    <div
                                        class="h-40 overflow-hidden rounded-lg bg-gray-200 mb-4">
                                        @if ($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="h-full w-full object-cover object-center">
                                        @else
                                            <div class="flex items-center justify-center h-full bg-gray-100">
                                                <span class="text-gray-400">No image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $product->description }}</p>
                                    <p class="text-indigo-600 font-bold mt-2">Rp{{ number_format($product->price, 2) }}
                                    </p>
                                    <span class="text-xs text-gray-500">{{ $product->category->name }}</span>
                                    <button onclick="addToCart({{ $product->id }})"
                                        class="mt-4 w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Tambah
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Cart Sidebar -->
                <div class="w-1/3 bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-bold mb-4">Shopping Cart</h2>
                        <div id="cart-items" class="space-y-4 mb-4 max-h-[calc(100vh-400px)] overflow-y-auto">
                            <!-- nama produk dan harga akan ditampilkan disini ketika tombol add to cart di klik -->
                        </div>
                        <div class="border-t pt-4">
                            <div class="flex justify-between mb-2">
                                <span>Subtotal:</span>
                                <span id="subtotal">Rp0</span>
                            </div>
                            <div class="flex justify-between font-bold text-lg">
                                <span>Total:</span>
                                <span id="total">Rp0</span>
                            </div>
                        </div>
                        <button onclick="processOrder()"
                            class="w-full mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Process Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-bold mb-4">Select Payment Method</h3>
            <div class="flex flex-col space-y-4">
                <button onclick="selectPaymentMethod('cash')"
                        class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                    Cash
                </button>
                <button onclick="selectPaymentMethod('online')"
                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Online Payment
                </button>
                <button onclick="closePaymentModal()"
                        class="w-full px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2">
                    Cancel
                </button>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- Midtrans Snap JS -->
        <script type="text/javascript"
                src="https://app.sandbox.midtrans.com/snap/snap.js"
                data-client-key="{{ config('midtrans.client_key') }}"></script>
        <script>
            let cart = [];

            function filterProducts() {
                const searchValue = document.getElementById('searchInput').value.toLowerCase();
                const products = document.querySelectorAll('.product-card');

                products.forEach(product => {
                    const name = product.dataset.name;
                    const category = product.dataset.category;
                    const shouldShow = name.includes(searchValue) || category.includes(searchValue);
                    product.style.display = shouldShow ? 'block' : 'none';
                });
            }

            function addToCart(productId) {
                console.log('Attempting to add product with ID:', productId);
                fetch(`/api/products/${productId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(product => {
                        console.log('Product fetched:', product);
                        const existingItem = cart.find(item => item.id === product.id);
                        if (existingItem) {
                            existingItem.quantity += 1;
                        } else {
                            cart.push({
                                id: product.id,
                                name: product.name,
                                price: parseFloat(product.price), // Ensure price is a number
                                quantity: 1
                            });
                        }
                        console.log('Current cart:', cart);
                        updateCartDisplay();
                    })
                    .catch(error => {
                        console.error('Error adding to cart:', error);
                        alert('Error adding product to cart. Check console for details.');
                    });
            }

            function updateCartDisplay() {
                console.log('Updating cart display...');
                const cartContainer = document.getElementById('cart-items');
                cartContainer.innerHTML = '';

                cart.forEach(item => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'flex justify-between items-center p-2 border-b';
                    itemElement.innerHTML = `
                    <div>
                        <h4 class="font-semibold">${item.name}</h4>
                        <div class="flex items-center mt-1">
                            <button onclick="updateQuantity(${item.id}, ${item.quantity - 1})"
                                    class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none">-</button>
                            <span class="mx-2">${item.quantity}</span>
                            <button onclick="updateQuantity(${item.id}, ${item.quantity + 1})"
                                    class="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300 focus:outline-none">+</button>
                        </div>
                    </div>
                    <div class="text-right">
                        <p>Rp${(item.price * item.quantity).toFixed(2)}</p>
                        <button onclick="removeFromCart(${item.id})"
                                class="text-red-600 text-sm hover:text-red-700">Remove</button>
                    </div>
                `;
                    cartContainer.appendChild(itemElement);
                });

                updateTotals();
            }

            function updateQuantity(productId, newQuantity) {
                if (newQuantity <= 0) {
                    removeFromCart(productId);
                    return;
                }

                const item = cart.find(item => item.id === productId);
                if (item) {
                    item.quantity = newQuantity;
                    updateCartDisplay();
                }
            }

            function removeFromCart(productId) {
                cart = cart.filter(item => item.id !== productId);
                updateCartDisplay();
            }

            function updateTotals() {
                const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                const total = subtotal; // No tax

                console.log('Subtotal:', subtotal, 'Type:', typeof subtotal);
                console.log('Total:', total, 'Type:', typeof total);

                document.getElementById('subtotal').textContent = `Rp${subtotal.toFixed(2)}`;
                document.getElementById('total').textContent = `Rp${total.toFixed(2)}`;
            }

            function processOrder() {
                if (cart.length === 0) {
                    alert('Cart is empty!');
                    return;
                }
                document.getElementById('paymentModal').classList.remove('hidden');
            }

            function closePaymentModal() {
                document.getElementById('paymentModal').classList.add('hidden');
            }

            function selectPaymentMethod(method) {
                console.log('Selected payment method:', method);
                if (method === 'online') {
                    fetch('/api/sales', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                items: cart,
                                payment_method: method
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.snap_token) {
                                snap.pay(data.snap_token, {
                                    onSuccess: function(result) {
                                        /* You may add your own implementation here */
                                        alert("Payment success!");
                                        console.log(result);
                                        cart = [];
                                        updateCartDisplay();
                                        closePaymentModal();
                                        window.location.href = `/pos/receipt/${data.sale_id}`; // Redirect to receipt
                                    },
                                    onPending: function(result) {
                                        /* You may add your own implementation here */
                                        alert("Waiting for your payment!");
                                        console.log(result);
                                        cart = [];
                                        updateCartDisplay();
                                        closePaymentModal();
                                        window.location.href = `/pos/receipt/${data.sale_id}`; // Redirect to receipt
                                    },
                                    onError: function(result) {
                                        /* You may add your own implementation here */
                                        alert("Payment failed!");
                                        console.log(result);
                                        closePaymentModal();
                                    },
                                    onClose: function() {
                                        /* You may add your own implementation here */
                                        alert('You closed the popup without finishing the payment');
                                        closePaymentModal();
                                    }
                                });
                            } else {
                                alert('Error: Snap token not received.');
                                closePaymentModal();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error processing order for online payment');
                            closePaymentModal();
                        });
                } else {
                    // For cash payment, proceed directly
                    fetch('/api/sales', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                items: cart,
                                payment_method: method
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert('Order processed successfully with ' + method + ' payment!');
                            cart = [];
                            updateCartDisplay();
                            closePaymentModal();
                            window.location.href = `/pos/receipt/${data.sale_id}`; // Redirect to receipt
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error processing order for cash payment');
                            closePaymentModal();
                        });
                }
            }
        </script>
    @endpush
</x-app-layout>
