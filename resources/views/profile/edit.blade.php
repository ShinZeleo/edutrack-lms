<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 mb-2">Profil</h1>
                <p class="text-lg text-neutral-600">Kelola informasi akun dan pengaturan Anda</p>
            </div>


            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8 mb-8">
                <div class="flex items-center gap-6 mb-8">
                    <div class="h-24 w-24 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white text-3xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900 mb-1">{{ Auth::user()->name }}</h2>
                        <p class="text-neutral-600 mb-2">{{ Auth::user()->email }}</p>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ Auth::user()->isAdmin() ? 'bg-red-100 text-red-700' : (Auth::user()->isTeacher() ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700') }}">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <section class="bg-white border-2 border-neutral-200 rounded-2xl shadow-lg p-8">
                    <header class="mb-6 flex items-center gap-3">
                        <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-neutral-900">
                                Informasi Profil
                            </h3>
                            <p class="mt-1 text-sm text-neutral-600">
                                Perbarui informasi dasar akunmu. Data ini akan tampil di kursus dan dashboard.
                            </p>
                        </div>
                    </header>

                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </section>

                <section class="bg-white border-2 border-neutral-200 rounded-2xl shadow-lg p-8">
                    <header class="mb-6 flex items-center gap-3">
                        <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-neutral-900">
                                Ubah Kata Sandi
                            </h3>
                            <p class="mt-1 text-sm text-neutral-600">
                                Gunakan kata sandi yang kuat dan tidak mudah ditebak.
                            </p>
                        </div>
                    </header>

                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </section>

                <section class="bg-white border-2 border-red-200 rounded-2xl shadow-lg p-8">
                    <header class="mb-6 flex items-center gap-3">
                        <div class="h-10 w-10 rounded-lg bg-red-100 flex items-center justify-center">
                            <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-red-700">
                                Hapus Akun
                            </h3>
                            <p class="mt-1 text-sm text-neutral-600">
                                Tindakan ini bersifat permanen. Semua data yang terkait akunmu akan ikut terhapus.
                            </p>
                        </div>
                    </header>

                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
