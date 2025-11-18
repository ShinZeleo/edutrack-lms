<x-app-layout>
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <section class="mb-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Welcome to EduTrack LMS</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Discover and master new skills with our comprehensive learning platform.
            Enroll in courses taught by expert instructors and track your progress.
        </p>
    </section>

    <!-- Popular Courses Section -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Popular Courses</h2>

        @if($courses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
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

                            <p class="text-gray-600 mb-4 text-sm">{{ Str::limit($course->description, 100) }}</p>

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
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">No popular courses available at the moment.</p>
        @endif
    </section>
</div>
</x-app-layout>