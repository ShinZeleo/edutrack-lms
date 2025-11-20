<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 mb-2">Admin Profile</h1>
                <p class="text-lg text-neutral-600">Kelola platform EduTrack LMS</p>
            </div>

            
            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8 mb-8">
                <h2 class="text-2xl font-bold text-neutral-900 mb-6">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Name</label>
                        <p class="text-lg text-neutral-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Username</label>
                        <p class="text-lg text-neutral-900">{{ $user->username }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Email</label>
                        <p class="text-lg text-neutral-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-neutral-700 mb-2">Role</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                            {{ $user->getRoleLabelAttribute() }}
                        </span>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8">
                <h2 class="text-2xl font-bold text-neutral-900 mb-6">Admin Overview</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <a href="{{ route('admin.dashboard') }}" class="bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-6 rounded-xl shadow-lg transition transform hover:scale-105">
                        <div class="text-4xl font-bold mb-2">{{ App\Models\User::count() }}</div>
                        <div class="text-lg font-semibold">Users</div>
                    </a>
                    <a href="{{ route('courses.index') }}" class="bg-gradient-to-br from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white p-6 rounded-xl shadow-lg transition transform hover:scale-105">
                        <div class="text-4xl font-bold mb-2">{{ App\Models\Course::count() }}</div>
                        <div class="text-lg font-semibold">Courses</div>
                    </a>
                    <a href="{{ route('categories.index') }}" class="bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white p-6 rounded-xl shadow-lg transition transform hover:scale-105">
                        <div class="text-4xl font-bold mb-2">{{ App\Models\Category::count() }}</div>
                        <div class="text-lg font-semibold">Categories</div>
                    </a>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-neutral-900 mb-4">Quick Actions</h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('admin.users') }}" class="px-6 py-3 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 rounded-lg font-semibold transition">
                            Manage Users
                        </a>
                        <a href="{{ route('courses.index') }}" class="px-6 py-3 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 rounded-lg font-semibold transition">
                            Manage Courses
                        </a>
                        <a href="{{ route('categories.index') }}" class="px-6 py-3 bg-neutral-100 hover:bg-neutral-200 text-neutral-700 rounded-lg font-semibold transition">
                            Manage Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
