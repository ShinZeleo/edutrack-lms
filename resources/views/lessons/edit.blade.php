@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Lesson - {{ $lesson->title }}</h1>
        
        <div class="bg-white shadow-md rounded-lg p-6">
            <form action="{{ route('teacher.courses.lessons.update', [$course, $lesson]) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-bold mb-2">Lesson Title *</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $lesson->title) }}" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="content" class="block text-gray-700 font-bold mb-2">Content *</label>
                    <textarea name="content" 
                              id="content" 
                              rows="8" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('content', $lesson->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="order" class="block text-gray-700 font-bold mb-2">Order *</label>
                    <input type="number" 
                           name="order" 
                           id="order" 
                           value="{{ old('order', $lesson->order) }}" 
                           min="0" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    <p class="text-gray-500 text-xs mt-1">Higher numbers appear later in the course</p>
                    @error('order')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Lesson
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection