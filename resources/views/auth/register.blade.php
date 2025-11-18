<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center space-y-1">
            <p class="text-xs uppercase tracking-[0.4em] text-primary-500">EduTrack LMS</p>
            <h1 class="text-2xl font-semibold text-neutral-900">Buat akun baru</h1>
            <p class="text-sm text-neutral-500">Hanya Teacher dan Student yang dapat melakukan registrasi.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="username" :value="__('Username')" />
                <x-text-input id="username" type="text" name="username" :value="old('username')" required />
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="role" :value="__('Role')" />
                <div class="grid grid-cols-2 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="student" class="peer sr-only" {{ old('role') == 'student' ? 'checked' : '' }} required>
                        <div class="rounded-xl border border-neutral-200 px-4 py-3 text-center text-sm font-semibold text-neutral-600 peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700">
                            Student
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="teacher" class="peer sr-only" {{ old('role') == 'teacher' ? 'checked' : '' }} required>
                        <div class="rounded-xl border border-neutral-200 px-4 py-3 text-center text-sm font-semibold text-neutral-600 peer-checked:border-primary-600 peer-checked:bg-primary-50 peer-checked:text-primary-700">
                            Teacher
                        </div>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="btn-primary w-full justify-center py-2 text-base">Register</button>
        </form>

        <div class="space-y-2 text-center text-sm text-neutral-500">
            <p>Admin tidak dapat membuat akun dari halaman ini. Akun admin dibuat oleh administrator sistem.</p>
            <a href="{{ route('login') }}" class="font-semibold text-primary-600 hover:text-primary-700">Sudah punya akun? Masuk</a>
        </div>
    </div>
</x-guest-layout>