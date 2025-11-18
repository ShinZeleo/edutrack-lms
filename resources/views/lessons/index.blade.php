<x-app-layout>
    <section class="py-8 space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Lesson Management</p>
                <h1 class="text-3xl font-semibold text-neutral-900">{{ $course->name }} - Lessons</h1>
            </div>
            <a href="{{ route('teacher.courses.lessons.create', $course) }}" class="btn-primary">+ Tambah lesson</a>
        </div>

        @if(session('success'))
            <div class="rounded-2xl border border-success-50 bg-success-50 px-4 py-3 text-success-600">
                {{ session('success') }}
            </div>
        @endif

        <div class="surface-card">
            <table class="min-w-full divide-y divide-neutral-200 text-sm">
                <thead class="bg-neutral-50 text-xs font-semibold uppercase tracking-wide text-neutral-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Order</th>
                        <th class="px-4 py-3 text-left">Judul</th>
                        <th class="px-4 py-3 text-left">Ringkasan</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($lessons as $lesson)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-neutral-900">{{ $lesson->order }}</td>
                            <td class="px-4 py-3 text-neutral-900">{{ $lesson->title }}</td>
                            <td class="px-4 py-3 text-neutral-500">{{ Str::limit(strip_tags($lesson->content), 80) }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('teacher.courses.lessons.edit', [$course, $lesson]) }}" class="text-primary-600 hover:text-primary-800">Edit</a>
                                <form action="{{ route('teacher.courses.lessons.destroy', [$course, $lesson]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus lesson ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-3 text-danger hover:text-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-neutral-500">
                                Belum ada lesson. <a href="{{ route('teacher.courses.lessons.create', $course) }}" class="text-primary-600">Tambahkan sekarang</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>