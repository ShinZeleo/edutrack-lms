<x-app-layout>
    <section class="space-y-8 py-10">
        <div class="surface-card p-6 md:p-8">
            <div class="flex flex-wrap items-center gap-6">
                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary-50 text-2xl font-semibold text-primary-600">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="flex-1 space-y-1">
                    <h1 class="text-3xl font-semibold text-neutral-900">{{ $user->name }}</h1>
                    <p class="text-sm text-neutral-500">{{ $user->username }} • {{ $user->email }}</p>
                </div>
                @php
                    $roleColors = [
                        'admin' => 'bg-danger/10 text-danger',
                        'teacher' => 'bg-success-50 text-success-600',
                        'student' => 'bg-primary-50 text-primary-700',
                    ];
                @endphp
                <span class="badge {{ $roleColors[$user->role] ?? 'badge-muted' }}">{{ ucfirst($user->role) }}</span>
            </div>
        </div>

        @if($user->isStudent())
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-neutral-900">Kursus yang diikuti</h2>
                @if(isset($enrolledCourses) && $enrolledCourses->count())
                    <div class="grid gap-4 md:grid-cols-2">
                        @foreach($enrolledCourses as $course)
                            @php $progress = $course->getProgressForUser($user); @endphp
                            <div class="surface-card p-4 space-y-3">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-neutral-900">{{ $course->name }}</h3>
                                    <span class="text-xs text-neutral-500">{{ number_format($progress, 0) }}%</span>
                                </div>
                                <p class="text-xs text-neutral-500">Teacher: {{ $course->teacher->name ?? 'N/A' }}</p>
                                <div class="progress-track">
                                    <div class="progress-fill" style="width: {{ $progress }}%"></div>
                                </div>
                                <div class="flex gap-3 text-sm">
                                    <a href="{{ route('courses.public.show', $course) }}" class="text-primary-600">Detail</a>
                                    @if($course->lessons->count() > 0)
                                        <a href="{{ route('lessons.show', [$course, $course->lessons()->ordered()->first()]) }}" class="text-primary-600">Lanjutkan</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-neutral-500">Belum ada kursus yang diikuti.</p>
                @endif
            </div>
        @elseif($user->isTeacher())
            <div class="space-y-4">
                <h2 class="text-xl font-semibold text-neutral-900">Kursus yang diajarkan</h2>
                @if(isset($courses) && $courses->count())
                    <div class="surface-card overflow-hidden">
                        <table class="min-w-full divide-y divide-neutral-200 text-sm">
                            <thead class="bg-neutral-50 text-xs uppercase tracking-wide text-neutral-500">
                                <tr>
                                    <th class="px-4 py-3 text-left">Course</th>
                                    <th class="px-4 py-3 text-left">Students</th>
                                    <th class="px-4 py-3 text-left">Lessons</th>
                                    <th class="px-4 py-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100">
                                @foreach($courses as $course)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <p class="font-semibold text-neutral-900">{{ $course->name }}</p>
                                            <p class="text-xs text-neutral-500">{{ $course->category->name ?? 'Uncategorized' }}</p>
                                        </td>
                                        <td class="px-4 py-3 text-neutral-600">{{ $course->students_count }} siswa</td>
                                        <td class="px-4 py-3 text-neutral-600">{{ $course->lessons_count }} lessons</td>
                                        <td class="px-4 py-3 text-neutral-600 space-x-3">
                                            <a href="{{ route('teacher.courses.edit', $course) }}" class="text-primary-600">Kelola</a>
                                            <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="text-success-600">Lesson</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-sm text-neutral-500">Belum ada kursus yang dibuat.</p>
                @endif
            </div>
        @else
            <div class="surface-card p-6">
                <h2 class="text-xl font-semibold text-neutral-900">Admin overview</h2>
                <p class="text-sm text-neutral-600">Gunakan sidebar admin untuk mengelola users, courses, dan categories.</p>
            </div>
        @endif
    </section>
</x-app-layout>