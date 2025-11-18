<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Dashboard</p>
                <h2 class="text-2xl font-semibold text-slate-900">Halo, {{ auth()->user()->name }} 👋</h2>
                <p class="text-sm text-slate-500">Pantau progress belajar dan tindakan penting langsung dari satu layar.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('courses.catalog') }}" class="pill-link pill-link--ghost text-xs sm:text-sm">Lihat katalog</a>
                @if(auth()->user()->isTeacher() || auth()->user()->isAdmin())
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.courses.create') : route('teacher.courses.create') }}" class="pill-link pill-link--brand text-xs sm:text-sm">Buat kursus</a>
                @endif
            </div>
        </div>
    </x-slot>

    @php
        $user = auth()->user();
        $stats = [
            [
                'label' => 'Peran aktif',
                'value' => ucfirst($user->role),
                'description' => 'Hak akses & rekomendasi UI dipersonalisasi.',
            ],
            [
                'label' => 'Kursus diajar',
                'value' => $user->isTeacher() ? $user->courses()->count() : ($user->isAdmin() ? App\Models\Course::count() : '—'),
                'description' => $user->isTeacher() ? 'Modul yang Anda kurasi saat ini.' : 'Total kursus dalam ekosistem.',
            ],
            [
                'label' => 'Kursus diikuti',
                'value' => $user->isStudent() ? $user->enrolledCourses()->count() : '—',
                'description' => $user->isStudent() ? 'Progress otomatis tersimpan.' : 'Tersedia bagi seluruh siswa.',
            ],
        ];

        $quickLinks = collect([
            ['label' => 'Kelola kursus admin', 'href' => route('admin.courses.index'), 'visible' => $user->isAdmin()],
            ['label' => 'Panel pengajar', 'href' => route('teacher.dashboard'), 'visible' => $user->isTeacher()],
            ['label' => 'Kursus saya', 'href' => route('student.dashboard'), 'visible' => $user->isStudent()],
            ['label' => 'Profil & keamanan', 'href' => route('profile.show'), 'visible' => true],
        ])->filter(fn($link) => $link['visible']);
    @endphp

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="glass-panel space-y-6 p-6 lg:col-span-2">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Ringkasan akun</p>
                    <h3 class="text-xl font-semibold text-slate-900">Semua status dalam kondisi prima.</h3>
                </div>
                <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-600">Realtime</span>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                @foreach($stats as $stat)
                    <div class="rounded-2xl border border-white/60 bg-white/70 p-5 shadow-sm">
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ $stat['label'] }}</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $stat['value'] }}</p>
                        <p class="mt-2 text-sm text-slate-500">{{ $stat['description'] }}</p>
                    </div>
                @endforeach
            </div>

            <div class="rounded-3xl bg-gradient-to-r from-primary-600 to-secondary-500 p-6 text-white">
                <p class="text-sm uppercase tracking-[0.4em] text-white/70">Aktivitas berikutnya</p>
                <h4 class="mt-2 text-2xl font-semibold">Selesaikan modul terbaru atau publish kurikulum baru.</h4>
                <div class="mt-4 flex flex-wrap gap-3 text-sm">
                    <span class="rounded-full bg-white/20 px-3 py-1">Checklist progress</span>
                    <span class="rounded-full bg-white/20 px-3 py-1">Reminder otomatis</span>
                    <span class="rounded-full bg-white/20 px-3 py-1">Timeline rilis</span>
                </div>
            </div>
        </div>

        <div class="glass-panel flex flex-col gap-6 p-6">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Quick links</p>
                <p class="text-sm text-slate-500">Akses fitur penting tanpa mencari menu.</p>
            </div>
            <div class="space-y-3">
                @foreach($quickLinks as $link)
                    <a href="{{ $link['href'] }}" class="flex items-center justify-between rounded-2xl border border-slate-100 bg-white/80 px-4 py-3 text-sm font-semibold text-slate-700 hover:border-primary-200 hover:text-primary-700">
                        <span>{{ $link['label'] }}</span>
                        <span>→</span>
                    </a>
                @endforeach
            </div>
            <div class="rounded-2xl border border-dashed border-slate-200 p-4 text-xs text-slate-500">
                Gunakan tombol “Buat kursus” untuk meluncurkan pengalaman baru atau update modul yang sudah berjalan.
            </div>
        </div>
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-2">
        <div class="glass-panel p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Aktivitas terbaru</p>
                    <h3 class="text-lg font-semibold text-slate-900">Timeline ringkas</h3>
                </div>
                <span class="text-xs text-slate-400">24h terakhir</span>
            </div>
            <ul class="mt-6 space-y-4 text-sm text-slate-600">
                <li class="flex items-start gap-3">
                    <span class="mt-1 h-2.5 w-2.5 rounded-full bg-primary-500"></span>
                    Periksa kembali modul yang baru dipublikasikan untuk memastikan semua media tampil prima.
                </li>
                <li class="flex items-start gap-3">
                    <span class="mt-1 h-2.5 w-2.5 rounded-full bg-secondary-500"></span>
                    Kirim pesan sambutan ke siswa baru agar onboarding terasa personal.
                </li>
                <li class="flex items-start gap-3">
                    <span class="mt-1 h-2.5 w-2.5 rounded-full bg-amber-500"></span>
                    Jadwalkan sesi live atau Q&A untuk menjaga engagement kelas.
                </li>
            </ul>
        </div>
        <div class="glass-panel p-6">
            <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Personal planner</p>
            <h3 class="text-lg font-semibold text-slate-900">Susun agenda minggu ini</h3>
            <div class="mt-6 space-y-4 text-sm text-slate-600">
                <div class="rounded-2xl border border-white/60 bg-white/80 p-4">
                    <p class="font-semibold text-slate-900">Review progress</p>
                    <p class="text-xs text-slate-500">Lihat statistik penyelesaian modul dan kirim reminder otomatis.</p>
                </div>
                <div class="rounded-2xl border border-white/60 bg-white/80 p-4">
                    <p class="font-semibold text-slate-900">Refresh konten</p>
                    <p class="text-xs text-slate-500">Perbarui video, PDF, atau kuis agar kursus selalu relevan.</p>
                </div>
                <div class="rounded-2xl border border-white/60 bg-white/80 p-4">
                    <p class="font-semibold text-slate-900">Kolaborasi tim</p>
                    <p class="text-xs text-slate-500">Gunakan komentar internal untuk menyatukan catatan antar pengajar.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
