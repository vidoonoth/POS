<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Receipt') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-2xl font-bold mb-4 text-center">Payment Receipt</h3>

            <div class="mb-4">
                <p><strong>Invoice Number:</strong> {{ $sale->invoice_number }}</p>
                <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y H:i') }}</p>
                <p><strong>Cashier:</strong> {{ $sale->user->name }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($sale->payment_method) }}</p>
                <p><strong>Status:</strong> {{ ucfirst($sale->status) }}</p>
            </div>

            <div class="mb-4">
                <h4 class="font-semibold text-lg mb-2">Items:</h4>
                <ul class="divide-y divide-gray-200">
                    @foreach($sale->details as $detail)
                        <li class="py-2 flex justify-between">
                            <span>{{ $detail->product->name }} ({{ $detail->quantity }} x Rp{{ number_format($detail->price, 2) }})</span>
                            <span>Rp{{ number_format($detail->subtotal, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="border-t pt-4 mt-4">
                <div class="flex justify-between text-lg font-semibold">
                    <span>Total:</span>
                    <span>Rp{{ number_format($sale->total_amount, 2) }}</span>
                </div>
            </div>

            <div class="mt-6 text-center">
                <button onclick="window.print()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Print Receipt
                </button>
                <a href="{{ route('pos.index') }}" class="ml-4 px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    New Sale
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
