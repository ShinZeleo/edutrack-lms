<x-app-layout>
    <section class="space-y-6 py-10">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Admin</p>
                <h1 class="text-3xl font-semibold text-neutral-900">User Management</h1>
                <p class="text-sm text-neutral-500">Kelola Admin, Teacher, Student dari satu tabel.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-primary">+ Tambah user</a>
        </div>

        <div class="surface-card p-4">
            <form method="GET" action="{{ route('admin.users.index') }}" class="grid gap-3 md:grid-cols-[2fr,1fr,auto]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email">
                <select name="role">
                    <option value="">Semua role</option>
                    <option value="admin" @selected(request('role')=='admin')>Admin</option>
                    <option value="teacher" @selected(request('role')=='teacher')>Teacher</option>
                    <option value="student" @selected(request('role')=='student')>Student</option>
                </select>
                <div class="flex gap-2">
                    <button type="submit" class="btn-primary">Filter</button>
                    @if(request()->hasAny(['search','role']))
                        <a href="{{ route('admin.users.index') }}" class="btn-ghost">Reset</a>
                    @endif
                </div>
            </form>
        </div>

        <div class="surface-card overflow-hidden">
            <table class="min-w-full divide-y divide-neutral-200 text-sm">
                <thead class="bg-neutral-50 text-xs uppercase tracking-wide text-neutral-500">
                    <tr>
                        <th class="px-4 py-3 text-left">User</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-neutral-900">{{ $user->name }}</p>
                                <p class="text-xs text-neutral-500">{{ $user->username }}</p>
                            </td>
                            <td class="px-4 py-3 text-neutral-600">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="badge {{ $user->role === 'admin' ? 'bg-danger/10 text-danger' : ($user->role === 'teacher' ? 'bg-success-50 text-success-600' : 'bg-primary-50 text-primary-700') }}">{{ ucfirst($user->role) }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="badge {{ $user->is_active ? 'badge-success' : 'badge-muted' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="px-4 py-3 text-right space-x-3">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-primary-600">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-neutral-500">Tidak ada user.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $users->appends(request()->query())->links() }}
    </section>
</x-app-layout>