<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Setting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Add a New Website Setting</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Fill in the details for the new setting.
                    </p>

                    <form method="POST" action="{{ route('admin.settings.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="key" :value="__('Setting Key')" />
                            <x-text-input id="key" name="key" type="text" class="mt-1 block w-full" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('key')" />
                        </div>

                        <div>
                            <x-input-label for="value" :value="__('Setting Value')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Setting') }}</x-primary-button>
                            <a href="{{ route('admin.settings.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
