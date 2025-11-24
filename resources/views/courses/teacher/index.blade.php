<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                <div>
                    <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide mb-1">Teacher</p>
                    <h1 class="text-4xl font-bold text-neutral-900">Kursus Saya</h1>
                </div>
                <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold shadow-lg transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Kursus
                </a>
            </div>


            @php
                // Array variasi gambar untuk course (10 variasi berbeda)
                $courseImages = [
                    'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&h=400&fit=crop',
                ];
            @endphp
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $index => $course)
                    <div class="bg-white border-2 border-neutral-200 rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden">
                        <div class="aspect-video bg-gradient-to-br from-emerald-400 to-blue-500 overflow-hidden">
                            <img
                                src="{{ $courseImages[$index % count($courseImages)] }}&sig={{ $course->id }}"
                                alt="{{ $course->name }}"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center rounded-lg bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                    {{ $course->category->name ?? 'General' }}
                                </span>
                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $course->is_active ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-700' }}">
                                    {{ $course->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-neutral-900 mb-2 line-clamp-2">{{ $course->name }}</h3>
                                <p class="text-sm text-neutral-600 line-clamp-2">{{ Str::limit($course->description, 80) }}</p>
                            </div>
                            <div class="flex items-center justify-between text-sm text-neutral-600">
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span class="font-medium">{{ $course->students_count ?? 0 }} siswa</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span class="font-medium">{{ $course->lessons_count ?? 0 }} lessons</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2 pt-2 border-t border-neutral-200">
                                <a href="{{ route('teacher.courses.edit', $course) }}" class="flex-1 text-center px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-semibold transition">
                                    Edit
                                </a>
                                <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="flex-1 text-center px-4 py-2 border-2 border-emerald-600 text-emerald-700 rounded-lg hover:bg-emerald-50 text-sm font-semibold transition">
                                    Lessons
                                </a>
                                <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus kursus ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-semibold transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white rounded-xl shadow-lg border border-neutral-200 p-12 text-center">
                        <svg class="h-16 w-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-neutral-600 mb-4">Belum ada kursus.</p>
                        <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Kursus Pertama
                        </a>
                    </div>
                @endforelse
            </div>

            @if(isset($courses) && method_exists($courses, 'hasPages') && $courses->hasPages())
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
