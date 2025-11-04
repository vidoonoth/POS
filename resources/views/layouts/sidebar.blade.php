<div class="w-56 bg-gray-800 text-white flex flex-col">
    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Categories</a>
        <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Products</a>
        <a href="{{ route('admin.sales.index') }}" class="block py-2 px-4 rounded hover:bg-gray-700">Sales</a>
        <a href="#" class="block py-2 px-4 rounded hover:bg-gray-700">Users</a>
    </nav>
</div>
