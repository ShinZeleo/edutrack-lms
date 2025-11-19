<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1">
            <p class="text-xs uppercase tracking-[0.25em] text-emerald-600">
                Lesson baru
            </p>
            <h2 class="text-xl font-semibold text-neutral-900">
                Tambah lesson untuk {{ $course->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white border border-neutral-200 rounded-xl shadow-sm p-6 md:p-8">
                <form
                    method="POST"
                    action="{{ route('teacher.courses.lessons.store', $course) }}"
                    class="space-y-5"
                >
                    @csrf

                    {{-- Judul lesson --}}
                    <div>
                        <label for="title" class="block text-sm font-medium text-neutral-800 mb-1">
                            Judul lesson *
                        </label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title') }}"
                            class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm text-neutral-800 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >
                        @error('title')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- Konten --}}
                    <div>
                        <label for="content" class="block text-sm font-medium text-neutral-800 mb-1">
                            Konten materi *
                        </label>
                        <textarea
                            name="content"
                            id="content"
                            rows="8"
                            class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm text-neutral-800 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >{{ old('content') }}</textarea>
                        @error('content')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-500">
                            Gunakan teks biasa. Jika perlu pemformatan, kamu bisa pakai baris baru dan penomoran manual.
                        </p>
                    </div>

                    {{-- Urutan lesson --}}
                    <div class="max-w-xs">
                        <label for="order" class="block text-sm font-medium text-neutral-800 mb-1">
                            Urutan lesson *
                        </label>
                        <input
                            type="number"
                            name="order"
                            id="order"
                            value="{{ old('order', 0) }}"
                            class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm text-neutral-800 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                            required
                        >
                        @error('order')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-500">
                            Nilai terkecil akan muncul lebih dulu di daftar materi.
                        </p>
                    </div>

                    {{-- Tombol aksi --}}
                    <div class="flex flex-col sm:flex-row sm:justify-end gap-3 pt-4 border-t border-neutral-200 mt-2">
                        <a
                            href="{{ route('teacher.courses.lessons.index', $course) }}"
                            class="inline-flex items-center justify-center rounded-lg border border-neutral-300 px-4 py-2 text-sm font-medium text-neutral-700 hover:bg-neutral-50"
                        >
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-emerald-700 shadow-sm"
                        >
                            Simpan lesson
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
