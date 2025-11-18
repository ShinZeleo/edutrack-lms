@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Course Catalog</h1>
    
    <!-- Search and Filter Section -->
    <div class="mb-6 bg-white p-4 rounded-lg shadow">
        <form method="GET" action="{{ route('courses.catalog') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       placeholder="Search courses..." 
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div>
                <select name="category_id" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Courses List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $course->name }}</h3>
                    <p class="text-gray-600 text-sm mb-3">By {{ $course->teacher->name ?? 'N/A' }}</p>
                    
                    <div class="flex justify-between items-center mb-3">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                            {{ $course->category->name ?? 'Uncategorized' }}
                        </span>
                        <span class="text-gray-500 text-sm">
                            {{ $course->students_count }} students
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($course->description, 120) }}</p>
                    
                    <!-- Progress for enrolled students -->
                    @auth
                        @if(auth()->user()->isStudent())
                            @php
                                $isEnrolled = $course->students->contains(auth()->user());
                                $progress = $isEnrolled ? $course->getProgressForUser(auth()->user()) : 0;
                            @endphp
                            
                            @if($isEnrolled)
                                <div class="mb-3">
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" 
                                             style="width: {{ $progress }}%"></div>
                                    </div>
                                    <div class="text-right text-xs text-gray-500 mt-1">
                                        {{ number_format($progress, 0) }}% Complete
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endauth
                    
                    <div class="flex justify-between">
                        <a href="{{ route('courses.public.show', $course) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            View Details
                        </a>
                        
                        @auth
                            @if(auth()->user()->isStudent())
                                @if($course->students->contains(auth()->user()))
                                    <span class="text-green-600 text-sm">Enrolled</span>
                                @else
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="bg-blue-600 hover:bg-blue-700 text-white text-sm py-1 px-3 rounded">
                                            Enroll
                                        </button>
                                    </form>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white text-sm py-1 px-3 rounded">
                                Login to Enroll
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">No courses found matching your criteria.</p>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="mt-8">
        {{ $courses->appends(request()->query())->links() }}
    </div>
</div>
@endsection