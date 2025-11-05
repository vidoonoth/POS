<div class="w-56 bg-gray-800 text-white flex flex-col">
    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Dashboard</a>
        <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.categories.index') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Categories</a>
        <a href="{{ route('admin.products.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.products.index') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Products</a>
        <a href="{{ route('admin.sales.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.sales.index') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Sales</a>
        <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.users.index') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Users</a>
        @can('manage settings')
        <a href="{{ route('admin.settings.index') }}" class="block py-2 px-4 rounded {{ request()->routeIs('admin.settings.index') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">Settings</a>
        @endcan
    </nav>
</div>
