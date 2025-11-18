<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h1 class="text-2xl font-bold text-slate-800">Student Profile</h1>
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
                        <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm">
                            {{ $user->getRoleLabelAttribute() }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Enrolled Courses -->
            <div>
                <h2 class="text-xl font-semibold text-slate-800 mb-4">My Enrolled Courses</h2>

                @if($enrolledCourses->count() > 0)
                    <div class="space-y-4">
                        @foreach($enrolledCourses as $course)
                            @php
                                $progress = $course->getProgressForUser($user);
                            @endphp
                            <div class="border border-slate-200 rounded-lg p-4 hover:bg-slate-50 transition-colors">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-bold text-slate-800">{{ $course->name }}</h3>
                                        <p class="text-slate-600 text-sm">By {{ $course->teacher->name }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                                            {{ number_format($progress, 0) }}% Complete
                                        </span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="w-full bg-slate-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" 
                                             style="width: {{ $progress }}%"></div>
                                    </div>
                                </div>

                                <div class="flex space-x-3">
                                    <a href="{{ route('courses.public.show', $course) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        View Course
                                    </a>

                                    @if($course->lessons->count() > 0)
                                        <a href="{{ route('lessons.show', [$course, $course->lessons()->ordered()->first()]) }}" 
                                           class="text-green-600 hover:text-green-800 text-sm font-medium">
                                            Continue Learning
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <p class="text-slate-500 mb-4">You haven't enrolled in any courses yet.</p>
                        <a href="{{ route('courses.catalog') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                            Browse Courses
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>