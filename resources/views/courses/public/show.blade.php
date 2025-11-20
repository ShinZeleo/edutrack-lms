<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 overflow-hidden mb-8">
                <div class="grid lg:grid-cols-3 gap-8 p-8">
                    <!-- Left: Course Info -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="inline-flex items-center rounded-lg bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                                {{ $course->category->name ?? 'General' }}
                            </span>
                            <span class="inline-flex items-center gap-1 rounded-lg bg-neutral-100 px-3 py-1.5 text-xs font-semibold text-neutral-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                {{ $course->students_count ?? 0 }} peserta
                            </span>
                        </div>

                        <div>
                            <h1 class="text-4xl font-bold text-neutral-900 mb-4">{{ $course->name }}</h1>
                            <div class="flex items-center gap-2 text-neutral-600 mb-4">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span class="font-medium">Mentor: {{ $course->teacher->name ?? 'Belum ditetapkan' }}</span>
                            </div>
                        </div>

                        <p class="text-lg text-neutral-700 leading-relaxed">{{ $course->description }}</p>

                        <div class="grid grid-cols-3 gap-4 pt-4 border-t border-neutral-200">
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500 mb-1">Durasi</p>
                                <p class="text-sm font-bold text-neutral-900">
                                    @if($course->start_date && $course->end_date)
                                        {{ $course->start_date->format('d M Y') }} - {{ $course->end_date->format('d M Y') }}
                                    @else
                                        Fleksibel
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500 mb-1">Lessons</p>
                                <p class="text-sm font-bold text-neutral-900">{{ $course->lessons->count() }} Lesson</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold uppercase tracking-wide text-neutral-500 mb-1">Status</p>
                                <p class="text-sm font-bold text-neutral-900">
                                    <span class="inline-flex items-center gap-1">
                                        <span class="h-2 w-2 rounded-full {{ $course->is_active ? 'bg-green-500' : 'bg-neutral-400' }}"></span>
                                        {{ $course->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Action Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-2xl p-6 text-white shadow-xl">
                            <p class="text-xs uppercase tracking-widest text-emerald-100 mb-2">Aksi</p>
                            <h2 class="text-2xl font-bold mb-6">{{ $isEnrolled ?? false ? 'Lanjutkan Belajar' : 'Ikuti Kursus' }}</h2>

                            @if(isset($studentProgress) && $studentProgress > 0)
                                <div class="mb-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-emerald-100">Progress</span>
                                        <span class="text-sm font-bold">{{ number_format($studentProgress, 0) }}%</span>
                                    </div>
                                    <div class="w-full bg-emerald-800 rounded-full h-3 overflow-hidden">
                                        <div class="bg-white h-full rounded-full transition-all duration-300" style="width: {{ $studentProgress }}%"></div>
                                    </div>
                                </div>
                            @endif

                            <div class="space-y-3">
                                @php $firstLesson = $course->lessons->first(); @endphp
                                @php $teacherEmail = optional($course->teacher)->email; @endphp

                                @guest
                                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full bg-white text-emerald-700 px-4 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition shadow-lg">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                        Login untuk Mengikuti
                                    </a>
                                @else
                                    @if(auth()->user()->isStudent())
                                        @if($isEnrolled ?? false)
                                            @if($firstLesson)
                                                <a href="{{ route('lessons.show', [$course, $firstLesson]) }}" class="flex items-center justify-center gap-2 w-full bg-white text-emerald-700 px-4 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition shadow-lg">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Lanjutkan Belajar
                                                </a>
                                            @else
                                                <div class="w-full bg-emerald-800 text-emerald-200 px-4 py-3 rounded-lg font-semibold text-center">
                                                    Lesson belum tersedia
                                                </div>
                                            @endif
                                        @else
                                            <form action="{{ route('courses.enroll', $course) }}" method="POST" class="w-full">
                                                @csrf
                                                <button type="submit" class="flex items-center justify-center gap-2 w-full bg-white text-emerald-700 px-4 py-3 rounded-lg font-semibold hover:bg-emerald-50 transition shadow-lg">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Ikuti Kursus
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <div class="w-full bg-emerald-800 text-emerald-200 px-4 py-3 rounded-lg text-sm text-center">
                                            Login sebagai Student untuk mengikuti course.
                                        </div>
                                    @endif
                                @endguest

                                @if($teacherEmail)
                                    <a href="mailto:{{ $teacherEmail }}" class="flex items-center justify-center gap-2 w-full border-2 border-white/60 text-white px-4 py-3 rounded-lg font-semibold hover:bg-white/10 transition">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Hubungi Teacher
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Left: Lesson List -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8">
                        <div class="flex items-center gap-2 mb-6">
                            <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <div>
                                <h2 class="text-2xl font-bold text-neutral-900">Daftar Lesson</h2>
                                <p class="text-sm text-neutral-600">{{ $course->lessons->count() }} lesson untuk menyelesaikan course ini.</p>
                            </div>
                        </div>

                        <ol class="space-y-3">
                            @php $showLessonStatus = auth()->check() && auth()->user()->isStudent(); @endphp
                            @foreach($course->lessons as $index => $lesson)
                                @php
                                    $isDoneLesson = $showLessonStatus ? ($lesson->progress->first()->is_done ?? false) : false;
                                @endphp
                                <li class="flex items-center justify-between rounded-xl border-2 {{ $isDoneLesson ? 'border-emerald-200 bg-emerald-50' : 'border-neutral-200 bg-white' }} px-5 py-4 hover:border-emerald-400 transition">
                                    <div class="flex items-center gap-4">
                                        <div class="flex-shrink-0 h-10 w-10 rounded-full {{ $isDoneLesson ? 'bg-emerald-600' : 'bg-neutral-200' }} flex items-center justify-center text-sm font-bold {{ $isDoneLesson ? 'text-white' : 'text-neutral-700' }}">
                                            @if($isDoneLesson)
                                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @else
                                                {{ $index + 1 }}
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-semibold text-neutral-900">{{ $index + 1 }}. {{ $lesson->title }}</p>
                                            <p class="text-xs text-neutral-500">Lesson {{ $index + 1 }}</p>
                                        </div>
                                    </div>
                                    @if($isDoneLesson)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            Selesai
                                        </span>
                                    @else
                                        <span class="text-xs text-neutral-500">Belum</span>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>

                <!-- Right: Course Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-6 sticky top-24">
                        <div class="flex items-center gap-2 mb-6">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-lg font-bold text-neutral-900">Informasi Kursus</h3>
                        </div>
                        <ul class="space-y-4 text-sm">
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-neutral-700">Kategori:</span>
                                    <span class="text-neutral-600 ml-1">{{ $course->category->name ?? 'General' }}</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-neutral-700">Teacher:</span>
                                    <span class="text-neutral-600 ml-1">{{ $course->teacher->name ?? 'Belum ditetapkan' }}</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="h-5 w-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <div>
                                    <span class="font-semibold text-neutral-700">Peserta aktif:</span>
                                    <span class="text-neutral-600 ml-1">{{ $course->students_count ?? 0 }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
