<x-app-layout>
    <section class="space-y-6 py-10">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Admin</p>
                <h1 class="text-3xl font-semibold text-neutral-900">Category Management</h1>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="btn-primary">+ Tambah kategori</a>
        </div>

        <div class="surface-card overflow-hidden">
            <table class="min-w-full divide-y divide-neutral-200 text-sm">
                <thead class="bg-neutral-50 text-xs uppercase tracking-wide text-neutral-500">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Deskripsi</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-4 py-3 font-semibold text-neutral-900">{{ $category->name }}</td>
                            <td class="px-4 py-3 text-neutral-600">{{ Str::limit($category->description, 100) }}</td>
                            <td class="px-4 py-3">
                                <span class="badge {{ $category->is_active ? 'badge-success' : 'badge-muted' }}">{{ $category->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="px-4 py-3 text-right space-x-3">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary-600">Edit</a>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-neutral-500">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>