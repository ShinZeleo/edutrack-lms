<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h1 class="text-2xl font-bold text-slate-800">Teacher Profile</h1>
        </div>

        <div class="p-6">
            <!-- Personal Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold text-slate-800 mb-4">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-600 text-sm font-medium mb-1">Name</label>
                        <p class="text-slate-800">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-slate-600 text-sm font-medium mb-1">Username</label>
                        <p class="text-slate-800">{{ $user->username }}</p>
                    </div>
                    <div>
                        <label class="block text-slate-600 text-sm font-medium mb-1">Email</label>
                        <p class="text-slate-800">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-slate-600 text-sm font-medium mb-1">Role</label>
                        <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">
                            {{ $user->getRoleLabelAttribute() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Teaching Courses -->
            <div>
                <h2 class="text-xl font-semibold text-slate-800 mb-4">My Courses</h2>

                @if($courses->count() > 0)
                    <div class="space-y-4">
                        @foreach($courses as $course)
                            <div class="border border-slate-200 rounded-lg p-4 hover:bg-slate-50 transition-colors">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-slate-800">{{ $course->name }}</h3>
                                        <p class="text-slate-600 text-sm">{{ Str::limit($course->description, 150) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-slate-800">{{ $course->students_count }}</div>
                                        <div class="text-sm text-slate-500">Students</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mt-3">
                                    <div>
                                        <div class="text-sm text-slate-500">Category</div>
                                        <div class="text-slate-800">{{ $course->category->name ?? 'Uncategorized' }}</div>
                                    </div>
                                    <div>
                                        <div class="text-sm text-slate-500">Lessons</div>
                                        <div class="text-slate-800">{{ $course->lessons_count }}</div>
                                    </div>
                                </div>

                                <div class="mt-4 flex space-x-3">
                                    <a href="{{ route('teacher.courses.edit', $course) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Edit Course
                                    </a>

                                    <a href="{{ route('teacher.courses.lessons.index', $course) }}" 
                                       class="text-green-600 hover:text-green-800 text-sm font-medium">
                                        Manage Lessons
                                    </a>

                                    <a href="{{ route('courses.public.show', $course) }}" 
                                       class="text-slate-600 hover:text-slate-800 text-sm font-medium">
                                        View Public
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-slate-500 mb-4">You haven't created any courses yet.</p>
                        <a href="{{ route('teacher.courses.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                            Create Your First Course
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>