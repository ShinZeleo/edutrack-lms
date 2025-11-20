<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-neutral-200 p-8">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-emerald-100 mb-4">
                    <svg class="h-8 w-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-neutral-900 mb-2">Login</h1>
                <p class="text-neutral-600">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-sm font-semibold text-neutral-700 mb-1.5" />
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" class="pl-10 block w-full rounded-lg border-neutral-300 focus:border-emerald-500 focus:ring-emerald-500" />
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-neutral-700" />
                        @if (Route::has('password.request'))
                            <a class="text-xs font-medium text-emerald-600 hover:text-emerald-700" href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <x-text-input id="password" type="password" name="password" required autocomplete="current-password" class="pl-10 block w-full rounded-lg border-neutral-300 focus:border-emerald-500 focus:ring-emerald-500" />
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <label for="remember_me" class="flex items-center gap-2 text-sm text-neutral-600 cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-neutral-300 text-emerald-600 focus:ring-emerald-500 w-4 h-4">
                    <span>Ingat saya</span>
                </label>

                <button type="submit" class="w-full bg-emerald-600 text-white px-6 py-3.5 rounded-lg hover:bg-emerald-700 transition font-semibold shadow-sm hover:shadow-md">
                    Login
                </button>
            </form>

            <div class="mt-6 pt-6 border-t border-neutral-200">
                <p class="text-center text-sm text-neutral-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
