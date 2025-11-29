<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center py-8 sm:py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-2xl shadow-2xl border border-neutral-200 p-8 sm:p-10">
                <div class="text-center mb-8">
                    <div class="mb-6">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 justify-center">
                            <svg class="h-8 w-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="text-2xl font-bold text-neutral-900">EduTrack</span>
                        </a>
                    </div>
                    <div class="inline-flex items-center justify-center h-14 w-14 rounded-full bg-emerald-100 mb-4">
                        <svg class="h-7 w-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-neutral-900 mb-2">Daftar Akun Baru</h1>
                    <p class="text-sm sm:text-base text-neutral-600">Pilih role dan lengkapi data Anda</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="role" :value="__('Pilih Role')" class="text-sm font-semibold text-neutral-700 mb-3" />
                        <div class="grid grid-cols-2 gap-3">
                            <label class="cursor-pointer group">
                                <input type="radio" name="role" value="student" class="peer sr-only" {{ old('role') == 'student' ? 'checked' : '' }} required>
                                <div class="rounded-xl border-2 border-neutral-300 px-3 py-4 text-center transition peer-checked:border-emerald-600 peer-checked:bg-emerald-50 group-hover:border-emerald-400">
                                    <svg class="h-7 w-7 mx-auto mb-2 text-neutral-400 peer-checked:text-emerald-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <div class="text-sm font-semibold text-neutral-600 peer-checked:text-emerald-700">Student</div>
                                </div>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="role" value="teacher" class="peer sr-only" {{ old('role') == 'teacher' ? 'checked' : '' }} required>
                                <div class="rounded-xl border-2 border-neutral-300 px-3 py-4 text-center transition peer-checked:border-emerald-600 peer-checked:bg-emerald-50 group-hover:border-emerald-400">
                                    <svg class="h-7 w-7 mx-auto mb-2 text-neutral-400 peer-checked:text-emerald-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <div class="text-sm font-semibold text-neutral-600 peer-checked:text-emerald-700">Teacher</div>
                                </div>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="name" :value="__('Nama')" class="text-sm font-semibold text-neutral-700 mb-2" />
                        <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="block w-full h-11 rounded-lg border-neutral-300 focus:border-emerald-500 focus:ring-emerald-500 text-base" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="username" :value="__('Username')" class="text-sm font-semibold text-neutral-700 mb-2" />
                        <x-text-input id="username" type="text" name="username" :value="old('username')" required class="block w-full h-11 rounded-lg border-neutral-300 focus:border-emerald-500 focus:ring-emerald-500 text-base" />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-sm font-semibold text-neutral-700 mb-2" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" class="block w-full h-11 rounded-lg border-neutral-300 focus:border-emerald-500 focus:ring-emerald-500 text-base" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-semibold text-neutral-700 mb-2" />
                        <x-text-input id="password" type="password" name="password" required autocomplete="new-password" class="block w-full h-11 rounded-lg border-neutral-300 focus:border-emerald-500 focus:ring-emerald-500 text-base" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-semibold text-neutral-700 mb-2" />
                        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" class="block w-full h-11 rounded-lg border-neutral-300 focus:border-emerald-500 focus:ring-emerald-500 text-base" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full bg-emerald-600 text-white px-6 py-3.5 rounded-lg hover:bg-emerald-700 transition font-semibold shadow-sm hover:shadow-md active:scale-[0.98] text-base">
                        Daftar
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t border-neutral-200 space-y-3">
                    <p class="text-center text-xs text-neutral-500">
                        Admin tidak dapat membuat akun dari halaman ini. Akun admin dibuat oleh administrator sistem.
                    </p>
                    <p class="text-center text-sm text-neutral-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 transition">Masuk</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

