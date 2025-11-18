<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center space-y-1">
            <p class="text-xs uppercase tracking-[0.4em] text-primary-500">EduTrack LMS</p>
            <h1 class="text-2xl font-semibold text-neutral-900">Masuk ke akun</h1>
            <p class="text-sm text-neutral-500">Gunakan email dan kata sandi yang telah terdaftar.</p>
        </div>

        <x-auth-session-status class="mb-2" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" class="mb-1" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="password" :value="__('Password')" />
                    @if (Route::has('password.request'))
                        <a class="text-xs font-medium text-primary-600 hover:text-primary-700" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <label for="remember_me" class="flex items-center gap-2 text-sm text-neutral-600">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-neutral-300 text-primary-600 focus:ring-primary-500">
                Ingat saya
            </label>

            <button type="submit" class="btn-primary w-full justify-center py-2 text-base">Login</button>
        </form>

        <p class="text-center text-sm text-neutral-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-primary-600 hover:text-primary-700">Daftar sebagai Teacher atau Student</a>
        </p>
    </div>
</x-guest-layout>