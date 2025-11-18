<x-app-layout>
    <section class="space-y-6 py-10">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Teacher</p>
                <h1 class="text-3xl font-semibold text-neutral-900">Kursus saya</h1>
            </div>
            <a href="{{ route('teacher.courses.create') }}" class="btn-primary">+ Buat kursus</a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($courses as $course)
                <div class="surface-card p-5 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="badge badge-primary">{{ $course->category->name ?? 'General' }}</span>
                        <span class="text-xs text-neutral-500">{{ $course->is_active ? 'Active' : 'Inactive' }}</span>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-neutral-900">{{ $course->name }}</h3>
                        <p class="text-sm text-neutral-500">{{ Str::limit($course->description, 80) }}</p>
                    </div>
                    <div class="text-xs text-neutral-500 flex items-center justify-between">
                        <span>{{ $course->students_count }} siswa</span>
                        <span>{{ $course->lessons_count }} lessons</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" style="width: {{ $course->students_count > 0 ? 80 : 0 }}%"></div>
                    </div>
                    <div class="flex flex-wrap gap-3 text-sm">
                        <a href="{{ route('teacher.courses.edit', $course) }}" class="text-primary-600">Edit</a>
                        <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="text-success-600">Lessons</a>
                        <form action="{{ route('teacher.courses.destroy', $course) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kursus ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center surface-card p-8">
                    <p class="text-neutral-500">Belum ada kursus.</p>
                    <a href="{{ route('teacher.courses.create') }}" class="btn-primary mt-4 inline-flex">Buat kursus pertama</a>
                </div>
            @endforelse
        </div>
        {{ $courses->links() }}
    </section>
</x-app-layout>