<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Category:</strong> {{ $product->category->name ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Name:</strong> {{ $product->name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>SKU:</strong> {{ $product->sku }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Description:</strong> {{ $product->description }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Price:</strong> Rp{{ number_format($product->price, 2, ',', '.') }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Image:</strong></p>
                        @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-40 w-40 object-cover rounded-lg mt-2">
                        @else
                            No Image
                        @endif
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
