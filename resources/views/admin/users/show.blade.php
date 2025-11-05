<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>ID:</strong> {{ $user->id }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Name:</strong> {{ $user->name }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Email:</strong> {{ $user->email }}</p>
                    </div>
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700"><strong>Roles:</strong></p>
                        <div class="mt-2 space-y-2">
                            @foreach ($user->roles as $role)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $role->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Users
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
