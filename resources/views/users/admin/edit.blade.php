<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 mb-2">Edit User: {{ $user->name }}</h1>
                <p class="text-lg text-neutral-600">Perbarui informasi pengguna</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8">
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="username" :value="__('Username')" />
                        <x-text-input id="username" type="text" name="username" :value="old('username', $user->username)" required />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email', $user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('New Password (optional)')" />
                        <x-text-input id="password" type="password" name="password" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <p class="mt-1 text-xs text-neutral-500">Kosongkan jika tidak ingin mengubah password</p>
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="role" :value="__('Role')" />
                        <select
                            name="role"
                            id="role"
                            class="block w-full rounded-lg border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-900 shadow-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-20 transition"
                            required
                        >
                            <option value="student" @selected(old('role', $user->role) == 'student')>Student</option>
                            <option value="teacher" @selected(old('role', $user->role) == 'teacher')>Teacher</option>
                            <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div>
                        <label for="is_active" class="flex items-center gap-3 cursor-pointer">
                            <input
                                id="is_active"
                                type="checkbox"
                                name="is_active"
                                value="1"
                                {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                class="h-5 w-5 rounded border-neutral-300 text-emerald-600 focus:ring-emerald-500"
                            >
                            <span class="text-sm font-semibold text-neutral-900">Is Active</span>
                        </label>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 border-t border-neutral-200">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-neutral-300 text-neutral-700 rounded-lg hover:bg-neutral-50 font-semibold transition">
                            Cancel
                        </a>
                        <x-primary-button>
                            Update User
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
