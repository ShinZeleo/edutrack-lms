<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 mb-2">Teacher Profile</h1>
                <p class="text-lg text-neutral-600">Kelola profil dan kursus Anda</p>
            </div>

            <!-- Personal Information Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8 mb-8">
                <h2 class="text-2xl font-bold text-neutral-900 mb-6">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Name</label>
                        <p class="text-lg text-neutral-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Username</label>
                        <p class="text-lg text-neutral-900">{{ $user->username }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Email</label>
                        <p class="text-lg text-neutral-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Role</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">
                            {{ $user->getRoleLabelAttribute() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- My Courses -->
            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-neutral-900">My Courses</h2>
                    <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold shadow-lg transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Course
                    </a>
                </div>

                @if($courses->count() > 0)
                    <div class="space-y-4">
                        @foreach($courses as $course)
                            <div class="border border-neutral-200 rounded-xl p-6 hover:shadow-md transition">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-neutral-900 mb-2">{{ $course->name }}</h3>
                                        <p class="text-neutral-600 mb-3">{{ Str::limit($course->description, 150) }}</p>
                                        <div class="flex flex-wrap gap-4 text-sm">
                                            <div>
                                                <span class="text-neutral-500">Category:</span>
                                                <span class="font-semibold text-neutral-900">{{ $course->category->name ?? 'Uncategorized' }}</span>
                                            </div>
                                            <div>
                                                <span class="text-neutral-500">Lessons:</span>
                                                <span class="font-semibold text-neutral-900">{{ $course->lessons_count }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center md:text-right">
                                        <div class="text-3xl font-bold text-emerald-600">{{ $course->students_count }}</div>
                                        <div class="text-sm text-neutral-500">Students</div>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-3 pt-4 border-t border-neutral-200">
                                    <a href="{{ route('teacher.courses.edit', $course) }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-semibold transition">
                                        Edit Course
                                    </a>
                                    <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-semibold transition">
                                        Manage Lessons
                                    </a>
                                    <a href="{{ route('courses.public.show', $course) }}" class="px-4 py-2 border-2 border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 text-sm font-semibold transition">
                                        View Public
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="h-16 w-16 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-neutral-600 mb-4 text-lg">You haven't created any courses yet.</p>
                        <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold shadow-lg transition">
                            Create Your First Course
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
