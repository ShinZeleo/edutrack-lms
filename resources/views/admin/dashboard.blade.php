<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-8 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-neutral-900 mb-2">Admin Dashboard</h1>
                <p class="text-base sm:text-lg text-neutral-600">Kelola platform dan pantau statistik keseluruhan</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-neutral-600">Total User</p>
                        <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-neutral-900">{{ $stats['totalUsers'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-neutral-600">Total Kursus</p>
                        <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-neutral-900">{{ $stats['totalCourses'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-neutral-600">Total Kategori</p>
                        <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-neutral-900">{{ $stats['totalCategories'] ?? 0 }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-sm font-medium text-neutral-600">Enrollment</p>
                        <div class="h-10 w-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl font-bold text-neutral-900">{{ $stats['totalEnrollments'] ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-4 sm:p-6 mb-6 sm:mb-8" data-aos="fade-up" data-aos-delay="500">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0 mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">User Management</h2>
                    <a href="{{ route('admin.users.index') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1">
                        Lihat Semua
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px]">
                        <thead class="bg-neutral-50 border-b border-neutral-200">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Nama</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Email</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Role</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Status</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200">
                            @forelse($recentUsers ?? [] as $user)
                                <tr class="hover:bg-neutral-50 transition">
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-sm font-semibold text-neutral-900">{{ $user->name }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-neutral-600">{{ $user->email }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4">
                                        <span class="inline-flex items-center rounded-full px-2 sm:px-3 py-1 text-xs font-semibold {{ $user->isAdmin() ? 'bg-red-100 text-red-700' : ($user->isTeacher() ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4">
                                        <span class="inline-flex items-center rounded-full px-2 sm:px-3 py-1 text-xs font-semibold {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-700' }}">
                                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-emerald-600 hover:text-emerald-700 font-semibold text-xs sm:text-sm transition">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-neutral-500">No users found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-4 sm:p-6 mb-6 sm:mb-8" data-aos="fade-up" data-aos-delay="600">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0 mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">Course Management</h2>
                    <a href="{{ route('admin.courses.index') }}" class="text-emerald-600 hover:text-emerald-700 font-semibold flex items-center gap-1">
                        Lihat Semua
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[640px]">
                        <thead class="bg-neutral-50 border-b border-neutral-200">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Nama Kursus</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Guru</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Siswa</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Status</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200">
                            @forelse($recentCourses ?? [] as $course)
                                <tr class="hover:bg-neutral-50 transition">
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-sm font-semibold text-neutral-900">{{ $course->name }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-neutral-600">{{ $course->teacher->name ?? 'N/A' }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-xs sm:text-sm text-neutral-600">{{ $course->students_count ?? 0 }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4">
                                        <span class="inline-flex items-center rounded-full px-2 sm:px-3 py-1 text-xs font-semibold {{ $course->is_active ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-700' }}">
                                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4">
                                        <a href="{{ route('admin.courses.edit', $course) }}" class="text-emerald-600 hover:text-emerald-700 font-semibold text-xs sm:text-sm transition">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-neutral-500">No courses found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-4 sm:p-6" data-aos="fade-up" data-aos-delay="700">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 sm:gap-0 mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-neutral-900">Category Management</h2>
                    <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold text-sm transition">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Kategori
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full min-w-[400px]">
                        <thead class="bg-neutral-50 border-b border-neutral-200">
                            <tr>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-4 sm:px-6 py-3 sm:py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200">
                            @forelse($categories ?? [] as $category)
                                <tr class="hover:bg-neutral-50 transition">
                                    <td class="px-4 sm:px-6 py-3 sm:py-4 text-sm font-semibold text-neutral-900">{{ $category->name }}</td>
                                    <td class="px-4 sm:px-6 py-3 sm:py-4">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('categories.edit', $category) }}" class="text-emerald-600 hover:text-emerald-700 font-semibold text-xs sm:text-sm transition">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-8 text-center text-neutral-500">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>