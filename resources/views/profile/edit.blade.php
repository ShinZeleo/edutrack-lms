<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-neutral-900">
            Profil
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl space-y-8">
            {{-- Informasi profil --}}
            <section class="bg-white border border-neutral-200 rounded-xl shadow-sm p-6">
                <header class="mb-6">
                    <h3 class="text-lg font-semibold text-neutral-900">
                        Informasi profil
                    </h3>
                    <p class="mt-1 text-sm text-neutral-600">
                        Perbarui informasi dasar akunmu. Data ini akan tampil di kursus dan dashboard.
                    </p>
                </header>

                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </section>

            {{-- Ubah password --}}
            <section class="bg-white border border-neutral-200 rounded-xl shadow-sm p-6">
                <header class="mb-6">
                    <h3 class="text-lg font-semibold text-neutral-900">
                        Ubah kata sandi
                    </h3>
                    <p class="mt-1 text-sm text-neutral-600">
                        Gunakan kata sandi yang kuat dan tidak mudah ditebak.
                    </p>
                </header>

                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </section>

            {{-- Hapus akun --}}
            <section class="bg-white border border-neutral-200 rounded-xl shadow-sm p-6">
                <header class="mb-6">
                    <h3 class="text-lg font-semibold text-red-700">
                        Hapus akun
                    </h3>
                    <p class="mt-1 text-sm text-neutral-600">
                        Tindakan ini bersifat permanen. Semua data yang terkait akunmu akan ikut terhapus.
                    </p>
                </header>

                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
    