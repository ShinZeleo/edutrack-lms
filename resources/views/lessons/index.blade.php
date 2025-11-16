@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">{{ $course->name }} - Lessons</h1>
        <a href="{{ route('teacher.courses.lessons.create', $course) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Lesson
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <ul class="divide-y divide-gray-200">
            @forelse($lessons as $lesson)
                <li class="p-4 hover:bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $lesson->title }}</h3>
                            <p class="text-sm text-gray-500">Order: {{ $lesson->order }}</p>
                        </div>
                        <div class="flex space-x-2">
                            <a href="{{ route('teacher.courses.lessons.edit', [$course, $lesson]) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                Edit
                            </a>
                            <form action="{{ route('teacher.courses.lessons.destroy', [$course, $lesson]) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Are you sure you want to delete this lesson?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @empty
                <li class="p-4 text-center text-gray-500">
                    No lessons found. <a href="{{ route('teacher.courses.lessons.create', $course) }}" class="text-blue-600 hover:underline">Add your first lesson</a>.
                </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection