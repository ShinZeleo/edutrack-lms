<x-app-layout>
    <section class="space-y-6 py-10">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Admin</p>
                <h1 class="text-3xl font-semibold text-neutral-900">Semua kursus</h1>
            </div>
            <a href="{{ route('admin.courses.create') }}" class="btn-primary">+ Buat kursus</a>
        </div>

        @if(session('success'))
            <div class="rounded-2xl border border-success-50 bg-success-50 px-4 py-3 text-success-600">
                {{ session('success') }}
            </div>
        @endif

        <div class="surface-card overflow-hidden">
            <table class="min-w-full divide-y divide-neutral-200 text-sm">
                <thead class="bg-neutral-50 text-xs uppercase tracking-wide text-neutral-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Kategori</th>
                        <th class="px-4 py-3 text-left">Teacher</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($courses as $course)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-neutral-900">{{ $course->name }}</td>
                            <td class="px-4 py-3 text-neutral-600">{{ $course->category->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-neutral-600">{{ $course->teacher->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-neutral-600">{{ $course->start_date->format('d M Y') }} - {{ $course->end_date->format('d M Y') }}</td>
                            <td class="px-4 py-3">
                                <span class="badge {{ $course->is_active ? 'badge-success' : 'badge-muted' }}">{{ $course->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="px-4 py-3 text-right space-x-3">
                                <a href="{{ route('admin.courses.edit', $course) }}" class="text-primary-600">Edit</a>
                                <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kursus ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-neutral-500">Belum ada kursus.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $courses->links() }}
    </section>
</x-app-layout>