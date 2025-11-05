<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sale Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Invoice Number:</strong> {{ $sale->invoice_number }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>User:</strong> {{ $sale->user->name ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Customer:</strong> {{ $sale->customer->name ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Total Amount:</strong> Rp{{ number_format($sale->total_amount, 2, ',', '.') }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Discount:</strong> Rp{{ number_format($sale->discount, 2, ',', '.') }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Final Amount:</strong> Rp{{ number_format($sale->final_amount, 2, ',', '.') }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Payment Method:</strong> {{ $sale->payment_method ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Status:</strong> {{ $sale->status }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Notes:</strong> {{ $sale->notes ?? 'N/A' }}</p>
                    </div>

                    <h3 class="text-lg font-medium text-gray-900 mt-6 mb-4">Products Sold</h3>
                    <div class="overflow-x-auto overflow-y-auto max-h-60">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Product Name
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Quantity
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Subtotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($sale->details as $detail)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $detail->product->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $detail->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Rp{{ number_format($detail->price, 2, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Rp{{ number_format($detail->subtotal, 2, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.sales.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Sales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
