@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $lesson->title }}</h1>
                    <p class="text-gray-600">{{ $course->name }}</p>
                </div>
                
                <div class="text-right">
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded">
                        Lesson {{ $lesson->order + 1 }}
                    </span>
                </div>
            </div>
            
            <!-- Progress bar -->
            <div class="mb-6">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                    <span>Course Progress</span>
                    <span>{{ number_format($courseProgress, 0) }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" 
                         style="width: {{ $courseProgress }}%"></div>
                </div>
            </div>
            
            <!-- Lesson Content -->
            <div class="prose max-w-none mb-8">
                {!! nl2br(e($lesson->content)) !!}
            </div>
            
            <!-- Navigation and Actions -->
            <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                <div>
                    @if($prevLesson)
                        <a href="{{ route('lessons.show', [$course, $prevLesson]) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            ← Previous Lesson
                        </a>
                    @endif
                </div>
                
                <div class="flex space-x-4">
                    <form action="{{ route('lessons.mark.' . ($isDone ? 'not.done' : 'done'), $lesson) }}" 
                          method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                class="{{ $isDone ? 'bg-gray-200 text-gray-800' : 'bg-blue-600 text-white' }} 
                                       hover:bg-blue-700 font-medium py-2 px-4 rounded">
                            {{ $isDone ? 'Mark as Not Done' : 'Mark as Done' }}
                        </button>
                    </form>
                    
                    @if($nextLesson)
                        <a href="{{ route('lessons.show', [$course, $nextLesson]) }}" 
                           class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded">
                            Next Lesson →
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection