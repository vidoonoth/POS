@can('dashboard')
    <x-app-layout>
        {{-- <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot> --}}

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold">Total Products</h3>
                                <p class="text-3xl font-bold">{{ $productCount ?? 0 }}</p>
                            </div>
                            <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold">Total Categories</h3>
                                <p class="text-3xl font-bold">{{ $categoryCount ?? 0 }}</p>
                            </div>
                            <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold">Total Customers</h3>
                                <p class="text-3xl font-bold">{{ $customerCount ?? 0 }}</p>
                            </div>
                            <div class="bg-red-500 text-white p-6 rounded-lg shadow-md">
                                <h3 class="text-lg font-semibold">Total Sales</h3>
                                <p class="text-3xl font-bold">{{ $saleCount ?? 0 }}</p>
                            </div>
                        </div>

                        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold mb-4">Sales Over Last 7 Days</h3>
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const ctx = document.getElementById('salesChart').getContext('2d');
                    const salesChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: @json($labels),
                            datasets: [{
                                label: 'Total Sales (Rp)',
                                data: @json($data),
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 1,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Total Sales (Rp)'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Date'
                                    }
                                }
                            }
                        }
                    });
                });
            </script>
        @endpush
    </x-app-layout>
@endcan

@can('pos')
    <script>
        window.location.href = "{{ route('pos.index') }}";
    </script>
@endcan
