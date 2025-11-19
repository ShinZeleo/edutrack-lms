<x-app-layout>
    <div class="mx-auto max-w-7xl px-8 py-8">
        <h1 class="text-3xl font-semibold text-neutral-900 mb-8">Teacher Dashboard</h1>

        <!-- Tabs -->
        <div class="border-b border-neutral-200 mb-6">
            <nav class="-mb-px flex space-x-8">
                <a href="#my-courses" class="tab-link active border-b-2 border-emerald-600 py-4 px-1 text-sm font-medium text-emerald-600">
                    My Courses
                </a>
                <a href="{{ route('teacher.courses.create') }}" class="tab-link border-b-2 border-transparent py-4 px-1 text-sm font-medium text-neutral-500 hover:text-neutral-700 hover:border-neutral-300">
                    Create Course
                </a>
                <a href="#students-progress" class="tab-link border-b-2 border-transparent py-4 px-1 text-sm font-medium text-neutral-500 hover:text-neutral-700 hover:border-neutral-300">
                    Students Progress
                </a>
            </nav>
        </div>

        <!-- Course List Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
                <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6 hover:shadow-md transition">
                    <!-- Thumbnail -->
                    <div class="aspect-video bg-neutral-200 rounded-lg mb-4 overflow-hidden">
                        <img src="https://source.unsplash.com/random/600x400?education&sig={{ $course->id }}" alt="{{ $course->name }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-semibold text-neutral-900 mb-2">{{ $course->name }}</h3>

                    <!-- Enrolled Count -->
                    <p class="text-sm text-neutral-600 mb-4">{{ $course->students_count ?? 0 }} siswa terdaftar</p>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <a href="{{ route('teacher.courses.edit', $course) }}" class="flex-1 text-center bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                            Edit Kursus
                        </a>
                        <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="flex-1 text-center border border-emerald-600 text-emerald-600 px-4 py-2 rounded-lg hover:bg-emerald-50 transition text-sm font-medium">
                            Kelola Lessons
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-neutral-50 rounded-lg border border-neutral-200">
                    <p class="text-neutral-600 mb-4">Belum ada kursus yang dibuat.</p>
                    <a href="{{ route('teacher.courses.create') }}" class="inline-block bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-medium">
                        Buat Kursus Pertama
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($courses->hasPages())
            <div class="mt-8">
                {{ $courses->links() }}
            </div>
        @endif
    </div>
</x-app-layout>

