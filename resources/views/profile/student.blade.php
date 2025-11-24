<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-neutral-900 mb-2">Halo, {{ $user->name }}!</h1>
                <p class="text-base sm:text-lg text-neutral-600">Pantau progress belajar dan kelola kursus Anda</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-600 mb-1">Total Kursus</p>
                            <p class="text-3xl font-bold text-emerald-600">{{ $enrolledCourses->count() }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-600 mb-1">Progress Rata-rata</p>
                            @php
                                $avgProgress = $enrolledCourses->count() > 0
                                    ? $enrolledCourses->avg(function($course) use ($user) {
                                        return $course->getProgressForUser($user) ?? 0;
                                    })
                                    : 0;
                            @endphp
                            <p class="text-3xl font-bold text-blue-600">{{ number_format($avgProgress, 0) }}%</p>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-600 mb-1">Kursus Selesai</p>
                            @php
                                $completedCourses = $enrolledCourses->filter(function($course) use ($user) {
                                    $progress = $course->getProgressForUser($user) ?? 0;
                                    return $progress >= 100;
                                })->count();
                            @endphp
                            <p class="text-3xl font-bold text-purple-600">{{ $completedCourses }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mb-6 sm:mb-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0 mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">Kursus Sedang Diikuti</h2>
                    <a href="{{ route('courses.catalog') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1 text-sm sm:text-base transition">
                        Jelajahi Kursus
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                @php
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
                @if($enrolledCourses->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                        @foreach($enrolledCourses as $index => $course)
                            @php
                                $progress = $course->getProgressForUser($user) ?? 0;
                            @endphp
                            <div class="bg-white rounded-xl shadow-lg border border-neutral-200 overflow-hidden hover:shadow-xl transition">
                                <div class="aspect-video bg-gradient-to-br from-emerald-400 to-blue-500 overflow-hidden relative">
                                    <img
                                        src="{{ $courseImages[$index % count($courseImages)] }}&sig={{ $course->id }}"
                                        alt="{{ $course->name }}"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <div class="p-4 sm:p-6">
                                    <h3 class="text-base sm:text-lg font-bold text-neutral-900 mb-2 line-clamp-2">{{ $course->name }}</h3>
                                    <p class="text-xs sm:text-sm text-neutral-600 mb-3 sm:mb-4">Oleh {{ $course->teacher->name ?? 'EduTrack' }}</p>


                                    <div class="mb-4">
                                        <div class="flex items-center justify-between text-xs sm:text-sm mb-2">
                                            <span class="font-semibold text-neutral-700">Progress</span>
                                            <span class="text-emerald-600 font-bold">{{ number_format($progress, 0) }}%</span>
                                        </div>
                                        <div class="w-full bg-neutral-200 rounded-full h-2.5">
                                            <div class="bg-emerald-600 h-2.5 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                                        <a href="{{ route('courses.public.show', $course) }}" class="flex-1 text-center px-4 py-2.5 border-2 border-neutral-300 rounded-lg text-xs sm:text-sm font-semibold text-neutral-700 hover:border-emerald-600 hover:text-emerald-600 transition">
                                            Detail
                                        </a>
                                        @if($progress >= 100)
                                            @php
                                                $certificate = \App\Models\Certificate::where('student_id', $user->id)
                                                    ->where('course_id', $course->id)
                                                    ->first();
                                            @endphp
                                            @if($certificate)
                                                <a href="{{ route('certificates.download', $certificate) }}" class="flex-1 text-center px-4 py-2.5 bg-emerald-600 rounded-lg text-xs sm:text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-sm hover:shadow-md flex items-center justify-center gap-1">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    Sertifikat
                                                </a>
                                            @else
                                                <a href="{{ route('courses.certificate', $course) }}" class="flex-1 text-center px-4 py-2.5 bg-emerald-600 rounded-lg text-xs sm:text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-sm hover:shadow-md">
                                                    Generate Sertifikat
                                                </a>
                                            @endif
                                        @elseif($course->lessons->count() > 0)
                                            <a href="{{ route('lessons.show', [$course, $course->lessons()->ordered()->first()]) }}" class="flex-1 text-center px-4 py-2.5 bg-emerald-600 rounded-lg text-xs sm:text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-sm hover:shadow-md">
                                                Lanjutkan
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-12 text-center">
                        <svg class="h-20 w-20 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="text-xl font-semibold text-neutral-900 mb-2">Belum ada kursus</h3>
                        <p class="text-neutral-600 mb-6">Mulai perjalanan belajar Anda dengan mengikuti kursus pertama.</p>
                        <a href="{{ route('courses.catalog') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition shadow-sm">
                            Jelajahi Kursus
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>

            <div class="mt-6 sm:mt-8">
                <h2 class="text-xl sm:text-2xl font-bold text-neutral-900 mb-4 sm:mb-6">Rekomendasi Kursus</h2>
                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-8 text-center">
                    <p class="text-neutral-600 mb-4">Temukan kursus baru yang sesuai dengan minat Anda</p>
                    <a href="{{ route('courses.catalog') }}" class="inline-flex items-center gap-2 px-6 py-3 border-2 border-emerald-600 text-emerald-700 rounded-lg hover:bg-emerald-50 font-semibold transition">
                        Lihat Semua Kursus
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
