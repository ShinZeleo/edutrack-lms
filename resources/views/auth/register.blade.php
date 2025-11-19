<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center space-y-1">
            <h1 class="text-2xl font-semibold text-neutral-900">Buat Akun Baru</h1>
            <p class="text-sm text-neutral-500">Hanya Teacher dan Student yang dapat melakukan registrasi.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="mt-1 block w-full rounded-lg border-neutral-300" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" type="text" name="username" :value="old('username')" required class="mt-1 block w-full rounded-lg border-neutral-300" />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="mt-1 block w-full rounded-lg border-neutral-300" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="role" :value="__('Role')" />
                <div class="grid grid-cols-2 gap-3 mt-1">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="student" class="peer sr-only" {{ old('role') == 'student' ? 'checked' : '' }} required>
                        <div class="rounded-lg border border-neutral-300 px-4 py-3 text-center text-sm font-semibold text-neutral-600 peer-checked:border-emerald-600 peer-checked:bg-emerald-50 peer-checked:text-emerald-700">
                            Student
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="teacher" class="peer sr-only" {{ old('role') == 'teacher' ? 'checked' : '' }} required>
                        <div class="rounded-lg border border-neutral-300 px-4 py-3 text-center text-sm font-semibold text-neutral-600 peer-checked:border-emerald-600 peer-checked:bg-emerald-50 peer-checked:text-emerald-700">
                            Teacher
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" class="mt-1 block w-full rounded-lg border-neutral-300" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="mt-1 block w-full rounded-lg border-neutral-300" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="w-full bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-medium">
                Register
            </button>
        </form>

        <div class="space-y-2 text-center text-sm text-neutral-500">
            <p>Admin tidak dapat membuat akun dari halaman ini. Akun admin dibuat oleh administrator sistem.</p>
            <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Sudah punya akun? Masuk</a>
        </div>
    </div>
</x-guest-layout>
