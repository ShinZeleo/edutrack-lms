<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center space-y-1">
            <h1 class="text-2xl font-semibold text-neutral-900">Masuk ke Akun</h1>
            <p class="text-sm text-neutral-500">Gunakan email dan kata sandi yang telah terdaftar.</p>
        </div>

        <x-auth-session-status class="mb-2" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="mt-1 block w-full rounded-lg border-neutral-300" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <x-input-label for="password" :value="__('Password')" />
                    @if (Route::has('password.request'))
                        <a class="text-xs font-medium text-emerald-600 hover:text-emerald-700" href="{{ route('password.request') }}">
                            {{ __('Lupa password?') }}
                        </a>
                    @endif
                </div>
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" class="mt-1 block w-full rounded-lg border-neutral-300" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <label for="remember_me" class="flex items-center gap-2 text-sm text-neutral-600">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-neutral-300 text-emerald-600 focus:ring-emerald-500">
                Ingat saya
            </label>

            <button type="submit" class="w-full bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition font-medium">
                Login
            </button>
        </form>

        <p class="text-center text-sm text-neutral-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Daftar sekarang</a>
        </p>
    </div>
</x-guest-layout>
