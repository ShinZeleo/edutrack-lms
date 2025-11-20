<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 mb-2">Create Category</h1>
                <p class="text-lg text-neutral-600">Tambah kategori baru untuk kursus</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8">
                <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="block w-full rounded-lg border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-900 shadow-sm placeholder:text-neutral-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-20 transition"
                        >{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div>
                        <label for="is_active" class="flex items-center gap-3 cursor-pointer">
                            <input
                                type="checkbox"
                                name="is_active"
                                id="is_active"
                                value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="h-5 w-5 rounded border-neutral-300 text-emerald-600 focus:ring-emerald-500"
                            >
                            <span class="text-sm font-semibold text-neutral-900">Active</span>
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-neutral-200">
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 font-semibold transition">
                            Cancel
                        </a>
                        <x-primary-button>
                            Create Category
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
