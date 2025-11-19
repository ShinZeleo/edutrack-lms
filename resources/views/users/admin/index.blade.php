<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-semibold text-xl text-neutral-800 leading-tight">
                {{ __('User Management') }}
            </h2>
            <a href="{{ route('admin.users.create') }}">
                <x-primary-button>
                    {{ __('+ Create User') }}
                </x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Filter Form -->
            <div class="bg-white p-4 sm:p-6 rounded-lg border border-neutral-200 shadow-sm">
                <form method="GET" action="{{ route('admin.users.index') }}">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <x-text-input name="search" type="text" class="w-full" placeholder="Search by name or email..." :value="request('search')" />
                        <select name="role" class="w-full rounded-lg border-neutral-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                            <option value="">All Roles</option>
                            <option value="admin" @selected(request('role') == 'admin')>Admin</option>
                            <option value="teacher" @selected(request('role') == 'teacher')>Teacher</option>
                            <option value="student" @selected(request('role') == 'student')>Student</option>
                        </select>
                        <div class="flex items-center gap-2">
                            <x-primary-button class="w-full justify-center">Filter</x-primary-button>
                            <a href="{{ route('admin.users.index') }}" class="w-full">
                                <x-secondary-button class="w-full justify-center">Reset</x-secondary-button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Users Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-neutral-200">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 text-sm">
                        <thead class="bg-neutral-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">User</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Role</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-neutral-200">
                            @forelse($users as $user)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="font-medium text-neutral-900">{{ $user->name }}</div>
                                                <div class="text-neutral-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span @class([
                                            'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                            'bg-rose-100 text-rose-800' => $user->isAdmin(),
                                            'bg-teal-100 text-teal-800' => $user->isTeacher(),
                                            'bg-sky-100 text-sky-800' => $user->isStudent(),
                                        ])>
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span @class([
                                            'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                                            'bg-green-100 text-green-800' => $user->is_active,
                                            'bg-neutral-100 text-neutral-800' => !$user->is_active,
                                        ])>
                                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-primary-600 hover:text-primary-900">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline ml-4" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-neutral-500">
                                        No users found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($users->hasPages())
                <div class="p-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>