<x-app-layout>
    @php
        $user = Auth::user();
    @endphp

    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 mb-2">Dashboard</h1>
                <p class="text-lg text-neutral-600">Selamat datang, {{ $user->name }}!</p>
            </div>

            
            <div class="bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-2xl shadow-xl p-8 mb-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
                        <p class="text-emerald-100">Role: <span class="font-semibold capitalize">{{ $user->role ?? 'user' }}</span></p>
                    </div>
                    <div class="h-16 w-16 rounded-full bg-white/20 backdrop-blur flex items-center justify-center">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>

            
            @if(isset($stats))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @foreach($stats as $label => $value)
                        <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6">
                            <p class="text-sm font-medium text-neutral-600 mb-2">{{ $label }}</p>
                            <p class="text-3xl font-bold text-emerald-600">{{ $value }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            
            @if($user->role === 'student')
                <section class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-neutral-900">Kursus yang Sedang Diikuti</h2>
                        <a href="{{ route('courses.catalog') }}" class="inline-flex items-center gap-2 px-4 py-2 text-emerald-600 hover:text-emerald-700 font-semibold">
                            Jelajahi Kursus Lain
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($enrolledCourses ?? [] as $course)
                            @php
                                $progress = $course->progress_percent ?? 0;
                            @endphp
                            <div class="bg-white border-2 border-neutral-200 rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden">
                                <div class="aspect-video bg-gradient-to-br from-emerald-400 to-blue-500 overflow-hidden">
                                    <img
                                        src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop&sig={{ $course->id }}"
                                        alt="{{ $course->name }}"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <div class="p-6">
                                    <h4 class="text-lg font-bold text-neutral-900 mb-2 line-clamp-2">{{ $course->name }}</h4>
                                    <p class="text-sm text-neutral-600 mb-4 line-clamp-2">{{ Str::limit($course->description, 100) }}</p>

                                    <div class="mb-4">
                                        <div class="flex items-center justify-between text-sm mb-2">
                                            <span class="font-semibold text-neutral-700">Progress</span>
                                            <span class="text-emerald-600 font-bold">{{ $progress }}%</span>
                                        </div>
                                        <div class="w-full bg-neutral-200 rounded-full h-2.5">
                                            <div class="bg-emerald-600 h-2.5 rounded-full transition-all" style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>

                                    <a href="{{ route('courses.public.show', $course) }}" class="inline-flex items-center justify-center w-full px-4 py-2.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition shadow-sm">
                                        Lanjutkan Belajar
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-xl shadow-lg border border-neutral-200 p-12 text-center">
                                <svg class="h-16 w-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-neutral-600 mb-4">Kamu belum mengikuti kursus apa pun.</p>
                                <a href="{{ route('courses.catalog') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition">
                                    Jelajahi Kursus
                                </a>
                            </div>
                        @endforelse
                    </div>
                </section>

            
            @elseif($user->role === 'teacher')
                <section class="space-y-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-neutral-900">Kursus yang Kamu Ajar</h2>
                        <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold shadow-lg transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Kursus Baru
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($teacherCourses ?? [] as $course)
                            <div class="bg-white border-2 border-neutral-200 rounded-xl shadow-lg hover:shadow-xl transition overflow-hidden">
                                <div class="aspect-video bg-gradient-to-br from-emerald-400 to-blue-500 overflow-hidden">
                                    <img
                                        src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop&sig={{ $course->id }}"
                                        alt="{{ $course->name }}"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="inline-flex items-center rounded-lg bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            {{ $course->category->name ?? 'General' }}
                                        </span>
                                        <span class="text-xs text-neutral-500">{{ $course->students_count ?? 0 }} siswa</span>
                                    </div>
                                    <h4 class="text-lg font-bold text-neutral-900 mb-2 line-clamp-2">{{ $course->name }}</h4>
                                    <p class="text-sm text-neutral-600 mb-4 line-clamp-2">{{ Str::limit($course->description, 100) }}</p>
                                    <div class="flex gap-2">
                                        <a href="{{ route('teacher.courses.edit', $course) }}" class="flex-1 text-center px-4 py-2 border-2 border-neutral-300 rounded-lg text-sm font-semibold text-neutral-700 hover:border-emerald-600 hover:text-emerald-600 transition">
                                            Edit
                                        </a>
                                        <a href="{{ route('teacher.courses.show', $course) }}" class="flex-1 text-center px-4 py-2 bg-emerald-600 rounded-lg text-sm font-semibold text-white hover:bg-emerald-700 transition">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white rounded-xl shadow-lg border border-neutral-200 p-12 text-center">
                                <svg class="h-16 w-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <p class="text-neutral-600 mb-4">Kamu belum membuat course.</p>
                                <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition">
                                    Buat Kursus Pertama
                                </a>
                            </div>
                        @endforelse
                    </div>
                </section>

            
            @elseif($user->role === 'admin')
                <section class="space-y-6">
                    <h2 class="text-2xl font-bold text-neutral-900">Administrasi Platform</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <a href="{{ route('admin.users.index') }}" class="bg-white border-2 border-neutral-200 rounded-xl shadow-lg p-6 hover:border-emerald-500 hover:shadow-xl transition group">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="h-12 w-12 rounded-xl bg-blue-100 group-hover:bg-blue-200 transition flex items-center justify-center">
                                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-neutral-900">Manajemen User</h3>
                            </div>
                            <p class="text-neutral-600">Kelola admin, teacher, dan student.</p>
                        </a>
                        <a href="{{ route('admin.courses.index') }}" class="bg-white border-2 border-neutral-200 rounded-xl shadow-lg p-6 hover:border-emerald-500 hover:shadow-xl transition group">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="h-12 w-12 rounded-xl bg-emerald-100 group-hover:bg-emerald-200 transition flex items-center justify-center">
                                    <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-neutral-900">Manajemen Kursus</h3>
                            </div>
                            <p class="text-neutral-600">Pantau dan atur seluruh kursus yang tersedia.</p>
                        </a>
                        <a href="{{ route('categories.index') }}" class="bg-white border-2 border-neutral-200 rounded-xl shadow-lg p-6 hover:border-emerald-500 hover:shadow-xl transition group">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="h-12 w-12 rounded-xl bg-purple-100 group-hover:bg-purple-200 transition flex items-center justify-center">
                                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-neutral-900">Manajemen Kategori</h3>
                            </div>
                            <p class="text-neutral-600">Atur kategori untuk pengelompokan kursus.</p>
                        </a>
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
