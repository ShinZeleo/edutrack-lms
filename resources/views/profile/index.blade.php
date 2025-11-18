@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">User Profile</h1>
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1">Name</label>
                        <p class="text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1">Username</label>
                        <p class="text-gray-900">{{ $user->username }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1">Email</label>
                        <p class="text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1">Role</label>
                        <span class="inline-block bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded">
                            {{ $user->getRoleLabelAttribute() }}
                        </span>
                    </div>
                </div>
            </div>
            
            @if($user->isStudent())
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">My Courses</h2>
                    
                    @if(isset($enrolledCourses) && $enrolledCourses->count() > 0)
                        <div class="space-y-4">
                            @foreach($enrolledCourses as $course)
                                @php
                                    $progress = $course->getProgressForUser($user);
                                @endphp
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h3 class="font-semibold text-lg text-gray-800">{{ $course->name }}</h3>
                                            <p class="text-gray-600 text-sm">By {{ $course->teacher->name }}</p>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-sm font-medium text-gray-700">
                                                {{ number_format($progress, 0) }}% Complete
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full" 
                                                 style="width: {{ $progress }}%"></div>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3 flex space-x-2">
                                        <a href="{{ route('courses.public.show', $course) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            View Course
                                        </a>
                                        
                                        @if($course->lessons->count() > 0)
                                            <a href="{{ route('lessons.show', [$course, $course->lessons()->ordered()->first()]) }}" 
                                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Continue Learning
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">You haven't enrolled in any courses yet.</p>
                    @endif
                </div>
            @elseif($user->isTeacher())
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">My Courses</h2>
                    
                    @if(isset($courses) && $courses->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lessons</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progress</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($courses as $course)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $course->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $course->category->name ?? 'Uncategorized' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $course->students_count }} students
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $course->lessons_count }} lessons
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                <div class="w-32 bg-gray-200 rounded-full h-2">
                                                    <div class="bg-blue-600 h-2 rounded-full" 
                                                         style="width: {{ $course->students_count > 0 ? min(100, ($course->students_count / max(1, $course->students_count)) * 100) : 0 }}%">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('teacher.courses.edit', $course) }}" class="text-blue-600 hover:text-blue-900 mr-3">Manage</a>
                                                <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="text-green-600 hover:text-green-900">Lessons</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">You haven't created any courses yet.</p>
                    @endif
                </div>
            @else
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Admin Dashboard</h2>
                    <p class="text-gray-600">Welcome, administrator. You have full access to manage the platform.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection