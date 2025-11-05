<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Setting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Edit Website Setting</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Update the details for this setting.
                    </p>

                    <form method="POST" action="{{ route('admin.settings.update', $setting->id) }}" class="mt-6 space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <x-input-label for="key" :value="__('Setting Key')" />
                            <x-text-input id="key" name="key" type="text" class="mt-1 block w-full" value="{{ old('key', $setting->key) }}" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('key')" />
                        </div>

                        <div>
                            <x-input-label for="value" :value="__('Setting Value')" />
                            <x-text-input id="value" name="value" type="text" class="mt-1 block w-full" value="{{ old('value', $setting->value) }}" required />
                            <x-input-error class="mt-2" :messages="$errors->get('value')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save Changes') }}</x-primary-button>
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
