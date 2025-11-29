<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                <div>
                    <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide mb-1">Admin</p>
                    <h1 class="text-4xl font-bold text-neutral-900">Semua Kursus</h1>
                </div>
                <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold shadow-lg transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Kursus
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-xl border-2 border-green-200 bg-green-50 px-6 py-4 text-green-800 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                @forelse($courses as $course)
                    <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-4 sm:p-6 hover:shadow-xl transition">
                        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start gap-4 mb-3">
                                    <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-lg bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white flex-shrink-0">
                                        <svg class="h-6 w-6 sm:h-7 sm:w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-bold text-lg sm:text-xl text-neutral-900 mb-2">{{ $course->name }}</h3>
                                        <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-sm text-neutral-600">
                                            <div class="flex items-center gap-1.5">
                                                <svg class="h-4 w-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                                <span>{{ $course->category->name ?? 'N/A' }}</span>
                                            </div>
                                            <div class="flex items-center gap-1.5">
                                                <svg class="h-4 w-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span>{{ $course->teacher->name ?? 'N/A' }}</span>
                                            </div>
                                            @if($course->start_date && $course->end_date)
                                                <div class="flex items-center gap-1.5">
                                                    <svg class="h-4 w-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span>{{ $course->start_date->format('d M Y') }} - {{ $course->end_date->format('d M Y') }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full lg:w-auto">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center rounded-full px-3 py-1.5 text-xs font-semibold {{ $course->is_active ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-700' }}">
                                        {{ $course->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.courses.lessons.index', $course) }}" class="flex-1 sm:flex-none px-4 py-2 border-2 border-emerald-600 text-emerald-700 rounded-lg hover:bg-emerald-50 text-sm font-semibold transition shadow-sm hover:shadow-md text-center">
                                        Lessons
                                    </a>
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="flex-1 sm:flex-none px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-semibold transition shadow-sm hover:shadow-md text-center">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="flex-1 sm:flex-none" onsubmit="return confirm('Hapus kursus ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-semibold transition shadow-sm hover:shadow-md">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-12 text-center">
                        <svg class="h-16 w-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-neutral-500 text-lg">Belum ada kursus.</p>
                    </div>
                @endforelse
            </div>

            @if(isset($courses) && method_exists($courses, 'hasPages') && $courses->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-4">
                        {{ $courses->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
