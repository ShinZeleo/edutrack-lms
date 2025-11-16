@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Available Courses</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($courses as $course)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $course->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($course->description, 100) }}</p>
                    
                    <div class="mb-3">
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                            {{ $course->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between text-sm text-gray-500 mb-4">
                        <span>{{ $course->teacher->name ?? 'N/A' }}</span>
                        <span>{{ $course->start_date->format('M d, Y') }} - {{ $course->end_date->format('M d, Y') }}</span>
                    </div>
                    
                    <a href="{{ route('courses.public.show', $course) }}" 
                       class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        View Details
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500">No active courses available.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $courses->links() }}
    </div>
</div>
@endsection