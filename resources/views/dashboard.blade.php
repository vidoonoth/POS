@can('dashboard')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

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
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
@endcan

@can('pos')
    <script>
        window.location.href = "{{ route('pos.index') }}";
    </script>
@endcan
