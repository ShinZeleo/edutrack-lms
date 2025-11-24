<x-app-layout>
    <div class="mx-auto max-w-7xl px-8 py-8">
        <div class="mb-12">
            <div class="flex items-center gap-6">
                <div class="w-24 h-24 bg-emerald-100 rounded-full flex items-center justify-center">
                    <span class="text-emerald-700 font-bold text-3xl">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-neutral-900 mb-2">{{ $user->name }}</h1>
                    @php
                        $roleColors = [
                            'admin' => 'bg-red-100 text-red-700',
                            'teacher' => 'bg-blue-100 text-blue-700',
                            'student' => 'bg-emerald-100 text-emerald-700',
                        ];
                    @endphp
                    <span class="inline-block px-3 py-1 rounded-md text-sm font-medium {{ $roleColors[$user->role] ?? 'bg-neutral-100 text-neutral-700' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>
            </div>
        </div>

        @if($user->isStudent())
            <div>
                <h2 class="text-2xl font-semibold text-neutral-900 mb-6">Kursus yang Sedang Diikuti</h2>
                @if(isset($enrolledCourses) && $enrolledCourses->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($enrolledCourses as $course)
                            @php $progress = $course->getProgressForUser($user); @endphp
                            <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6 hover:shadow-md transition">
                                <h3 class="text-xl font-semibold text-neutral-900 mb-2">{{ $course->name }}</h3>
                                <p class="text-sm text-neutral-600 mb-4">Oleh {{ $course->teacher->name ?? 'EduTrack' }}</p>

                                <div class="mb-4">
                                    <div class="w-full bg-neutral-200 rounded-full h-2 mb-1">
                                        <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <p class="text-xs text-neutral-500">{{ number_format($progress, 0) }}% selesai</p>
                                </div>

                                <div class="flex gap-3">
                                    <a href="{{ route('courses.public.show', $course) }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                                        Detail
                                    </a>
                                    @if($course->lessons->count() > 0)
                                        <a href="{{ route('lessons.show', [$course, $course->lessons()->ordered()->first()]) }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                                            Lanjutkan
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-neutral-50 rounded-lg border border-neutral-200">
                        <p class="text-neutral-600 mb-4">Belum ada kursus yang diikuti.</p>
                        <a href="{{ route('courses.catalog') }}" class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-medium">
                            Jelajahi Kursus
                        </a>
                    </div>
                @endif
            </div>
        @elseif($user->isTeacher())
            <div>
                <h2 class="text-2xl font-semibold text-neutral-900 mb-6">Kursus yang Diajarkan</h2>
                @if(isset($courses) && $courses->count())
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6 hover:shadow-md transition">
                                <h3 class="text-xl font-semibold text-neutral-900 mb-2">{{ $course->name }}</h3>
                                <p class="text-sm text-neutral-600 mb-4">{{ $course->category->name ?? 'Uncategorized' }}</p>
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm text-neutral-600">{{ $course->students_count ?? 0 }} siswa</span>
                                    <span class="text-sm text-neutral-600">{{ $course->lessons_count ?? 0 }} lessons</span>
                                </div>
                                <div class="flex gap-3">
                                    <a href="{{ route('teacher.courses.edit', $course) }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                                        Kelola
                                    </a>
                                    <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                                        Lesson
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-neutral-50 rounded-lg border border-neutral-200">
                        <p class="text-neutral-600">Belum ada kursus yang dibuat.</p>
                    </div>
                @endif
            </div>
        @else
            <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6">
                <h2 class="text-2xl font-semibold text-neutral-900 mb-4">Admin Overview</h2>
                <p class="text-neutral-600">Gunakan sidebar admin untuk mengelola users, courses, dan categories.</p>
            </div>
        @endif
    </div>
</x-app-layout>
