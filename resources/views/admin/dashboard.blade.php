<x-app-layout>
    <div class="flex min-h-screen">
        <!-- Sidebar Left (Dark Neutral) -->
        <aside class="w-64 bg-neutral-900 text-neutral-300 min-h-screen sticky top-0">
            <div class="p-6">
                <h2 class="text-xl font-bold text-white mb-8">Admin Panel</h2>
                <nav class="space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg hover:bg-neutral-800 {{ request()->routeIs('admin.dashboard') ? 'bg-neutral-800 text-white' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-lg hover:bg-neutral-800 {{ request()->routeIs('admin.users.*') ? 'bg-neutral-800 text-white' : '' }}">
                        Users
                    </a>
                    <a href="{{ route('admin.courses.index') }}" class="block px-4 py-2 rounded-lg hover:bg-neutral-800 {{ request()->routeIs('admin.courses.*') ? 'bg-neutral-800 text-white' : '' }}">
                        Courses
                    </a>
                    <a href="{{ route('categories.index') }}" class="block px-4 py-2 rounded-lg hover:bg-neutral-800 {{ request()->routeIs('categories.*') ? 'bg-neutral-800 text-white' : '' }}">
                        Categories
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Right Panel -->
        <main class="flex-1 bg-neutral-50">
            <div class="p-8">
                <h1 class="text-3xl font-semibold text-neutral-900 mb-8">Dashboard</h1>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6">
                        <h3 class="text-sm text-neutral-500 mb-2">Total Users</h3>
                        <p class="text-3xl font-bold text-neutral-900">{{ $stats['totalUsers'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6">
                        <h3 class="text-sm text-neutral-500 mb-2">Total Courses</h3>
                        <p class="text-3xl font-bold text-neutral-900">{{ $stats['totalCourses'] ?? 0 }}</p>
                    </div>
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6">
                        <h3 class="text-sm text-neutral-500 mb-2">Total Categories</h3>
                        <p class="text-3xl font-bold text-neutral-900">{{ $stats['totalCategories'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold text-neutral-900 mb-4">Recent Users</h2>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="bg-neutral-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Name</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Role</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200">
                                @forelse($recentUsers ?? [] as $user)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-neutral-900">{{ $user->name }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-600">{{ $user->email }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            <span class="px-2 py-1 rounded-md text-xs font-medium {{ $user->isAdmin() ? 'bg-red-100 text-red-700' : ($user->isTeacher() ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <span class="px-2 py-1 rounded-md text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-700' }}">
                                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-neutral-500">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Courses Table -->
                <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-semibold text-neutral-900 mb-4">Recent Courses</h2>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="bg-neutral-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Course</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Teacher</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Category</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-neutral-500 uppercase tracking-wider">Students</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200">
                                @forelse($recentCourses ?? [] as $course)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-neutral-900">{{ $course->name }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-600">{{ $course->teacher->name ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-600">{{ $course->category->name ?? 'Uncategorized' }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-600">{{ $course->students_count ?? 0 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-neutral-500">No courses found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>

