<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide mb-1">Lesson Management</p>
                <h1 class="text-4xl font-bold text-neutral-900 mb-2">{{ $course->name }} - Lessons</h1>
                <p class="text-lg text-neutral-600">Kelola semua lesson untuk kursus ini</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <p class="text-sm font-semibold text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 overflow-hidden">
                <div class="p-6 border-b border-neutral-200 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-neutral-900">Daftar Lesson</h2>
                    <a href="{{ route('teacher.courses.lessons.create', $course) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold shadow-lg transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Lesson
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-neutral-50 border-b border-neutral-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Order</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Judul</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Ringkasan</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200">
                            @forelse($lessons as $lesson)
                                <tr class="hover:bg-neutral-50 transition">
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-700">
                                            {{ $lesson->order }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-neutral-900">{{ $lesson->title }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-neutral-600">{{ Str::limit(strip_tags($lesson->content), 80) }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('teacher.courses.lessons.edit', [$course, $lesson]) }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-semibold transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('teacher.courses.lessons.destroy', [$course, $lesson]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus lesson ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-semibold transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-neutral-500">
                                        <svg class="h-12 w-12 mx-auto text-neutral-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="mb-2">Belum ada lesson.</p>
                                        <a href="{{ route('teacher.courses.lessons.create', $course) }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                                            Tambahkan sekarang
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
