@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Admin Profile</h1>
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1">Name</label>
                        <p class="text-gray-900">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1">Username</label>
                        <p class="text-gray-900">{{ $user->username }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1">Email</label>
                        <p class="text-gray-900">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-1">Role</label>
                        <span class="inline-block bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded">
                            {{ $user->getRoleLabelAttribute() }}
                        </span>
                    </div>
                </div>
            </div>
            
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Admin Actions</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold">{{ App\Models\User::count() }}</div>
                        <div>Users</div>
                    </a>
                    <a href="{{ route('courses.index') }}" class="bg-green-600 hover:bg-green-700 text-white p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold">{{ App\Models\Course::count() }}</div>
                        <div>Courses</div>
                    </a>
                    <a href="{{ route('categories.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white p-4 rounded-lg text-center">
                        <div class="text-2xl font-bold">{{ App\Models\Category::count() }}</div>
                        <div>Categories</div>
                    </a>
                </div>
                
                <div class="mt-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-3">Quick Actions</h3>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('admin.users') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">
                            Manage Users
                        </a>
                        <a href="{{ route('courses.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">
                            Manage Courses
                        </a>
                        <a href="{{ route('categories.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded">
                            Manage Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection