<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 mb-2">Add New Lesson</h1>
                <p class="text-lg text-neutral-600">Tambah lesson baru untuk {{ $course->name }}</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8">
                <form action="{{ route('teacher.courses.lessons.store', $course) }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Lesson Title')" />
                        <x-text-input id="title" name="title" type="text" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" :value="__('Content')" />
                        <textarea
                            name="content"
                            id="content"
                            rows="10"
                            class="block w-full rounded-lg border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-900 shadow-sm placeholder:text-neutral-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-20 transition"
                            required
                        >{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        <p class="mt-1 text-xs text-neutral-500">Gunakan teks biasa. Jika perlu pemformatan, kamu bisa pakai baris baru dan penomoran manual.</p>
                    </div>

                    <div class="max-w-xs">
                        <x-input-label for="order" :value="__('Order')" />
                        <x-text-input id="order" name="order" type="number" :value="old('order', 0)" min="0" required />
                        <x-input-error :messages="$errors->get('order')" class="mt-2" />
                        <p class="mt-1 text-xs text-neutral-500">Nilai terkecil akan muncul lebih dulu di daftar materi.</p>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-neutral-200">
                        <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 font-semibold transition">
                            Cancel
                        </a>
                        <x-primary-button>
                            Create Lesson
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
