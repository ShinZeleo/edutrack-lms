<x-app-layout>
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <!-- Header -->
            <div class="mb-6 border-b border-border pb-6">
                <div class="bg-gray-200 h-64 rounded-lg mb-6 flex items-center justify-center">
                    <span class="text-gray-500 text-lg">Course Thumbnail</span>
                </div>
                
                <h1 class="text-3xl font-bold text-heading mb-4">{{ $course->name }}</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <span class="block text-textHint text-sm">Teacher</span>
                        <span class="text-textSecondary font-medium">{{ $course->teacher->name ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="block text-textHint text-sm">Category</span>
                        <span class="text-textSecondary font-medium">{{ $course->category->name ?? 'Uncategorized' }}</span>
                    </div>
                    <div>
                        <span class="block text-textHint text-sm">Duration</span>
                        <span class="text-textSecondary font-medium">{{ $course->lessons->count() }} Lessons</span>
                    </div>
                </div>
                
                <div class="mb-4">
                    <p class="text-textSecondary">{{ $course->description }}</p>
                </div>
                
                <div class="flex flex-wrap gap-4">
                    <div>
                        <span class="inline-block bg-primary-100 text-primary-800 text-sm px-3 py-1 rounded-full">
                            {{ $course->start_date->format('M d, Y') }}
                        </span>
                        <span class="mx-2 text-textHint">to</span>
                        <span class="inline-block bg-primary-100 text-primary-800 text-sm px-3 py-1 rounded-full">
                            {{ $course->end_date->format('M d, Y') }}
                        </span>
                    </div>
                    
                    <div>
                        <span class="inline-block bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">
                            {{ $course->students_count }} students enrolled
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Action Button -->
            <div class="mb-6">
                @auth
                    @if(auth()->user()->isStudent())
                        @if($course->students->contains(auth()->user()))
                            <a href="{{ route('lessons.show', [$course, $course->lessons()->ordered()->first()]) }}" 
                               class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-lg inline-block">
                                Continue Course
                            </a>
                            <span class="ml-4 text-green-600 font-medium">Enrolled</span>
                        @else
                            <form action="{{ route('courses.enroll', $course) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-lg">
                                    Enroll in Course
                                </button>
                            </form>
                        @endif
                    @else
                        <p class="text-textHint">Only students can enroll in this course.</p>
                    @endif
                @else
                    <a href="{{ route('login') }}" 
                       class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-lg">
                        Login to Enroll
                    </a>
                @endauth
            </div>
            
            <!-- Lesson List -->
            <div>
                <h2 class="text-2xl font-bold text-heading mb-4">Course Content</h2>
                
                @if($course->lessons->count() > 0)
                    <div class="bg-bgSection p-4 rounded-lg">
                        <div class="space-y-3">
                            @foreach($course->lessons()->ordered()->get() as $lesson)
                                <div class="flex items-center justify-between p-3 bg-white rounded border border-border">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 flex items-center justify-center bg-primary-100 text-primary-800 rounded-full text-sm font-bold mr-3">
                                            {{ $loop->iteration }}
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-heading">{{ $lesson->title }}</h4>
                                            <p class="text-textHint text-sm">{{ Str::limit($lesson->content, 80) }}</p>
                                        </div>
                                    </div>
                                    
                                    @auth
                                        @if(auth()->user()->isStudent() && $course->students->contains(auth()->user()))
                                            @php
                                                $progress = $lesson->progress()
                                                                  ->where('student_id', auth()->id())
                                                                  ->first();
                                                $isDone = $progress && $progress->is_done;
                                            @endphp
                                            
                                            <div>
                                                @if($isDone)
                                                    <span class="text-green-600 font-medium text-sm flex items-center">
                                                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                        Done
                                                    </span>
                                                @else
                                                    <span class="text-textHint text-sm">Pending</span>
                                                @endif
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-textHint">No lessons have been added to this course yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>