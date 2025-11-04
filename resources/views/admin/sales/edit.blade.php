<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Sale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.sales.update', $sale->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $sale->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer (Optional)</label>
                            <select name="customer_id" id="customer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id', $sale->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="invoice_number" class="block text-sm font-medium text-gray-700">Invoice Number</label>
                            <input type="text" name="invoice_number" id="invoice_number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('invoice_number', $sale->invoice_number) }}" required>
                            @error('invoice_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="discount" class="block text-sm font-medium text-gray-700">Discount</label>
                            <input type="number" name="discount" id="discount" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('discount', $sale->discount) }}" step="0.01">
                            @error('discount')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                            <input type="text" name="payment_method" id="payment_method" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('payment_method', $sale->payment_method) }}">
                            @error('payment_method')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="pending" {{ old('status', $sale->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ old('status', $sale->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $sale->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('notes', $sale->notes) }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <h3 class="text-lg font-medium text-gray-900 mt-6 mb-4">Products</h3>
                        <div id="product-items">
                            @foreach ($sale->details as $index => $detail)
                                <div class="flex items-center space-x-4 mb-4 product-item">
                                    <div class="flex-1">
                                        <label for="product_id_{{ $index }}" class="block text-sm font-medium text-gray-700">Product</label>
                                        <select name="products[{{ $index }}][product_id]" id="product_id_{{ $index }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                            <option value="">Select Product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" {{ old("products.{$index}.product_id", $detail->product_id) == $product->id ? 'selected' : '' }}>{{ $product->name }} (Rp{{ number_format($product->price, 2, ',', '.') }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-24">
                                        <label for="quantity_{{ $index }}" class="block text-sm font-medium text-gray-700">Quantity</label>
                                        <input type="number" name="products[{{ $index }}][quantity]" id="quantity_{{ $index }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old("products.{$index}.quantity", $detail->quantity) }}" min="1" required>
                                    </div>
                                    <button type="button" class="mt-6 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded remove-product-item">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-product-item" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">Add Product</button>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.sales.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Update Sale
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let productItemIndex = {{ count($sale->details) > 0 ? count($sale->details) : 1 }};

            document.getElementById('add-product-item').addEventListener('click', function () {
                const productItemsDiv = document.getElementById('product-items');
                const newItem = document.createElement('div');
                newItem.classList.add('flex', 'items-center', 'space-x-4', 'mb-4', 'product-item');
                newItem.innerHTML = `
                    <div class="flex-1">
                        <label for="product_id_${productItemIndex}" class="block text-sm font-medium text-gray-700">Product</label>
                        <select name="products[${productItemIndex}][product_id]" id="product_id_${productItemIndex}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} (Rp{{ number_format($product->price, 2, ',', '.') }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-24">
                        <label for="quantity_${productItemIndex}" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" name="products[${productItemIndex}][quantity]" id="quantity_${productItemIndex}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="1" min="1" required>
                    </div>
                    <button type="button" class="mt-6 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded remove-product-item">Remove</button>
                `;
                productItemsDiv.appendChild(newItem);
                productItemIndex++;
            });

            document.getElementById('product-items').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-product-item')) {
                    e.target.closest('.product-item').remove();
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
