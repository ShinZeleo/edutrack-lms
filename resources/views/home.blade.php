<x-app-layout>
    <section class="relative bg-gradient-to-br from-emerald-50 via-white to-blue-50 pt-16 pb-20 sm:pt-20 sm:pb-24 overflow-hidden">
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    <p class="inline-flex items-center gap-2 rounded-full bg-emerald-100 px-4 py-1.5 text-xs font-semibold text-emerald-700 mb-6">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        Platform Kursus Daring Terpercaya
                    </p>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-neutral-900 tracking-tight mb-4 sm:mb-6">
                        Belajar Skill Baru Dengan <span class="text-emerald-600">Lebih Mudah</span>
                    </h1>

                    <p class="text-base sm:text-lg md:text-xl text-neutral-600 leading-relaxed mb-6 sm:mb-8 max-w-xl mx-auto lg:mx-0 px-4 sm:px-0">
                        Akses kursus berkualitas dari mentor ahli. Bangun portofolio dan tingkatkan karier melalui pembelajaran terstruktur.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 sm:gap-4 mb-8 sm:mb-12 px-4 sm:px-0">
                        <a
                            href="{{ route('courses.catalog') }}"
                            class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl bg-emerald-600 text-white text-base font-semibold hover:bg-emerald-700 shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Lihat Kursus
                        </a>
                        @guest
                            <a
                                href="{{ route('register') }}"
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-xl border-2 border-neutral-300 text-base font-semibold text-neutral-700 hover:border-emerald-600 hover:text-emerald-600 bg-white transition-all"
                            >
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                Register
                            </a>
                        @endguest
                    </div>

                    <div class="grid grid-cols-3 gap-4 sm:gap-6 text-center lg:text-left px-4 sm:px-0">
                        <div>
                            <div class="text-2xl font-bold text-emerald-600">{{ $stats['activeCourses'] ?? 0 }}+</div>
                            <div class="text-sm text-neutral-600">Kursus Tersedia</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-emerald-600">{{ $stats['activeStudents'] ?? 0 }}+</div>
                            <div class="text-sm text-neutral-600">Siswa Aktif</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-emerald-600">{{ $stats['activeTeachers'] ?? 0 }}+</div>
                            <div class="text-sm text-neutral-600">Mentor Ahli</div>
                        </div>
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="relative z-10">
                        <img
                            src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop"
                            alt="Students learning online"
                            class="rounded-2xl shadow-2xl"
                        />
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-full h-full bg-emerald-200 rounded-2xl -z-10 opacity-30"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-16 border-t border-neutral-200 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-semibold text-neutral-900">
                        Kategori populer
                    </h2>
                    <p class="mt-2 text-sm text-neutral-600">
                        Pilih jalur belajar yang sesuai dengan minat dan kebutuhanmu.
                    </p>
                </div>
            </div>

            @php
                $categoryImages = [
                    'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=400&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=400&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=400&h=300&fit=crop',
                    'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=400&h=300&fit=crop',
                ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-5">
                @forelse(($categories ?? [])->take(4) as $index => $category)
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">
                        <div class="aspect-video bg-gradient-to-br from-emerald-400 to-blue-500 overflow-hidden relative">
                            <img
                                src="{{ $categoryImages[$index % count($categoryImages)] }}&sig={{ $category->id }}"
                                alt="{{ $category->name }}"
                                class="w-full h-full object-cover"
                            />
                        </div>
                        <div class="p-5 flex flex-col">
                            <h3 class="text-base font-semibold text-neutral-900 mb-1">
                                {{ $category->name }}
                            </h3>
                            <p class="text-sm text-neutral-600">
                                {{ $category->description ?? 'Kategori kursus berkualitas.' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-neutral-500">Belum ada kategori tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="featured-courses" class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-900 mb-3 sm:mb-4">
                    Kursus Populer
                </h2>
                <p class="text-base sm:text-lg text-neutral-600 max-w-2xl mx-auto px-4 sm:px-0">
                    Pilih dari berbagai kursus berkualitas yang telah membantu ribuan siswa meningkatkan skill mereka.
                </p>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @forelse($courses ?? [] as $index => $course)
                    <div class="bg-white border-2 border-neutral-200 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="aspect-video bg-gradient-to-br from-emerald-400 to-blue-500 overflow-hidden relative">
                            <img
                                src="{{ $courseImages[$index % count($courseImages)] }}&sig={{ $course->id }}"
                                alt="{{ $course->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                            />
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center rounded-lg bg-white/90 backdrop-blur px-3 py-1 text-xs font-semibold text-emerald-700 shadow-sm">
                                    {{ $course->category->name ?? 'Umum' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-4 sm:p-6 flex flex-col gap-3 sm:gap-4">
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-neutral-900 line-clamp-2 mb-2 group-hover:text-emerald-600 transition">
                                    <a href="{{ route('courses.public.show', $course) }}">
                                        {{ $course->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-neutral-600 line-clamp-2">
                                    {{ Str::limit($course->description, 100) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-2 text-neutral-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="font-medium">{{ $course->teacher->name ?? 'EduTrack' }}</span>
                                </div>
                                <div class="flex items-center gap-1 text-neutral-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>{{ $course->students_count ?? 0 }}</span>
                                </div>
                            </div>

                            <a
                                href="{{ route('courses.public.show', $course) }}"
                                class="mt-2 inline-flex items-center justify-center gap-2 w-full rounded-lg bg-emerald-600 px-4 py-2.5 sm:py-3 text-xs sm:text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-sm hover:shadow-md"
                            >
                                Lihat Kursus
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="h-16 w-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-neutral-500 text-lg">Belum ada kursus tersedia saat ini.</p>
                    </div>
                @endforelse

                @if(count($courses ?? []) > 0)
                    <a
                        href="{{ route('courses.catalog') }}"
                        class="bg-white border-2 border-neutral-200 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col items-center justify-center p-6 sm:p-8 group hover:border-emerald-500 min-h-[400px]"
                    >
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 text-emerald-600 mb-4 group-hover:bg-emerald-600 group-hover:text-white transition">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                        <h3 class="text-lg sm:text-xl font-bold text-neutral-900 mb-2 group-hover:text-emerald-600 transition text-center">
                            Lihat Semua Kursus
                        </h3>
                        <p class="text-sm text-neutral-600 text-center max-w-xs">
                            Jelajahi lebih banyak kursus berkualitas untuk meningkatkan skill Anda
                        </p>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-b from-neutral-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12 lg:mb-16">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-900 mb-3 sm:mb-4">
                    Fitur Platform
                </h2>
                <p class="text-base sm:text-lg text-neutral-600 max-w-2xl mx-auto px-4 sm:px-0">
                    Platform pembelajaran yang dirancang untuk memberikan pengalaman belajar terbaik.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <div class="bg-white border-2 border-neutral-200 rounded-2xl p-6 sm:p-8 text-center hover:border-emerald-500 hover:shadow-xl transition-all group">
                    <div class="inline-flex items-center justify-center h-14 w-14 sm:h-16 sm:w-16 rounded-2xl bg-emerald-100 text-emerald-600 mb-4 sm:mb-6 group-hover:bg-emerald-600 group-hover:text-white transition">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-neutral-900 mb-2 sm:mb-3">
                        Materi Terstruktur
                    </h3>
                    <p class="text-sm sm:text-base text-neutral-600 leading-relaxed">
                        Materi pembelajaran disusun secara sistematis dari dasar hingga tingkat lanjut, memudahkan proses belajar.
                    </p>
                </div>

                <div class="bg-white border-2 border-neutral-200 rounded-2xl p-6 sm:p-8 text-center hover:border-emerald-500 hover:shadow-xl transition-all group">
                    <div class="inline-flex items-center justify-center h-14 w-14 sm:h-16 sm:w-16 rounded-2xl bg-blue-100 text-blue-600 mb-4 sm:mb-6 group-hover:bg-blue-600 group-hover:text-white transition">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-neutral-900 mb-2 sm:mb-3">
                        Mentor Ahli
                    </h3>
                    <p class="text-sm sm:text-base text-neutral-600 leading-relaxed">
                        Belajar langsung dari mentor berpengalaman di bidangnya, siap membantu dan membimbing perjalanan belajar Anda.
                    </p>
                </div>

                <div class="bg-white border-2 border-neutral-200 rounded-2xl p-6 sm:p-8 text-center hover:border-emerald-500 hover:shadow-xl transition-all group">
                    <div class="inline-flex items-center justify-center h-14 w-14 sm:h-16 sm:w-16 rounded-2xl bg-purple-100 text-purple-600 mb-4 sm:mb-6 group-hover:bg-purple-600 group-hover:text-white transition">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-neutral-900 mb-2 sm:mb-3">
                        Progress Otomatis
                    </h3>
                    <p class="text-sm sm:text-base text-neutral-600 leading-relaxed">
                        Sistem pelacakan progres otomatis membantu Anda memantau perkembangan belajar secara real-time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-900 mb-3 sm:mb-4">
                    Apa Kata Mereka
                </h2>
                <p class="text-base sm:text-lg text-neutral-600 px-4 sm:px-0">
                    Testimoni dari siswa yang telah merasakan manfaat platform ini.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                <div class="bg-gradient-to-br from-emerald-50 to-white border-2 border-emerald-100 rounded-2xl p-4 sm:p-6 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <img
                            src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop&crop=face"
                            alt="Student"
                            class="h-12 w-12 rounded-full object-cover border-2 border-emerald-200"
                        />
                        <div>
                            <h4 class="font-semibold text-neutral-900">Sarah Putri</h4>
                            <p class="text-sm text-neutral-600">Mahasiswa Sistem Informasi</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="text-sm sm:text-base text-neutral-700 leading-relaxed">
                        "Platform ini membuat proses belajar terasa lebih terarah. Fitur progres dan pemecahan materi per lesson sangat membantu saya mengatur waktu belajar."
                    </blockquote>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-white border-2 border-blue-100 rounded-2xl p-4 sm:p-6 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <img
                            src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face"
                            alt="Student"
                            class="h-12 w-12 rounded-full object-cover border-2 border-blue-200"
                        />
                        <div>
                            <h4 class="font-semibold text-neutral-900">Ahmad Rizki</h4>
                            <p class="text-sm text-neutral-600">Web Developer</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="text-sm sm:text-base text-neutral-700 leading-relaxed">
                        "Materi yang disajikan sangat lengkap dan mudah dipahami. Mentor juga sangat responsif dalam menjawab pertanyaan."
                    </blockquote>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-white border-2 border-purple-100 rounded-2xl p-4 sm:p-6 shadow-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <img
                            src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face"
                            alt="Student"
                            class="h-12 w-12 rounded-full object-cover border-2 border-purple-200"
                        />
                        <div>
                            <h4 class="font-semibold text-neutral-900">Dewi Sari</h4>
                            <p class="text-sm text-neutral-600">UI/UX Designer</p>
                        </div>
                    </div>
                    <div class="flex gap-1 mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="text-sm sm:text-base text-neutral-700 leading-relaxed">
                        "Sangat membantu dalam meningkatkan skill saya. Progress tracking yang otomatis membuat saya lebih termotivasi untuk menyelesaikan kursus."
                    </blockquote>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
