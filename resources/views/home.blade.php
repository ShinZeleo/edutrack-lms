<x-app-layout>
    <!-- Hero center -->
    <section class="pt-20 pb-16">
        <div class="max-w-3xl mx-auto text-center">
            <p class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-4 py-1 text-xs font-medium text-emerald-700 mb-4">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                Platform kursus daring untuk belajar terstruktur
            </p>

            <h1 class="text-4xl md:text-5xl font-bold text-neutral-900 tracking-tight">
                Belajar skill digital dengan cara yang terarah dan menyenangkan
            </h1>

            <p class="mt-4 text-base md:text-lg text-neutral-600 leading-relaxed">
                Bangun portofolio dan tingkatkan karier melalui kursus interaktif.
                Materi disusun bertahap, mentor aktif, dan progres belajar bisa kamu pantau sendiri.
            </p>

            <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a
                    href="{{ route('courses.catalog') }}"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-emerald-600 text-white text-sm font-medium hover:bg-emerald-700 shadow-sm transition"
                >
                    Mulai Jelajahi Kursus
                </a>
                <a
                    href="#featured-courses"
                    class="inline-flex items-center justify-center px-5 py-3 rounded-lg border border-neutral-200 text-sm font-medium text-neutral-700 hover:bg-neutral-50"
                >
                    Lihat kursus unggulan
                </a>
            </div>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm text-neutral-600">
                <div class="flex flex-col items-center gap-1">
                    <span class="text-base font-semibold text-neutral-900">Belajar fleksibel</span>
                    <span>Kapan saja dari mana saja</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <span class="text-base font-semibold text-neutral-900">Materi terstruktur</span>
                    <span>Dari dasar sampai projek</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <span class="text-base font-semibold text-neutral-900">Monitoring progres</span>
                    <span>Lihat seberapa jauh kamu belajar</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Kategori populer -->
    <section class="py-12 border-t border-neutral-200 bg-neutral-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-semibold text-neutral-900">
                        Kategori populer
                    </h2>
                    <p class="mt-2 text-sm text-neutral-600">
                        Pilih jalur belajar yang sesuai dengan minat dan kebutuhanmu.
                    </p>
                </div>
            </div>

            @php
                $defaultCategories = [
                    ['name' => 'Web Development', 'description' => 'Bangun aplikasi web modern dan responsif.'],
                    ['name' => 'Data & Analytics', 'description' => 'Kelola dan analisis data untuk pengambilan keputusan.'],
                    ['name' => 'UI/UX & Design', 'description' => 'Rancang pengalaman pengguna yang nyaman dan menarik.'],
                    ['name' => 'Programming Fundamentals', 'description' => 'Kuasai dasar pemrograman sebelum masuk ke topik lanjut.'],
                ];
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($defaultCategories as $category)
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition p-5 flex flex-col">
                        <div class="inline-flex items-center justify-center h-10 w-10 rounded-lg bg-emerald-50 text-emerald-600 mb-4">
                            <span class="text-lg">★</span>
                        </div>
                        <h3 class="text-base font-semibold text-neutral-900 mb-1">
                            {{ $category['name'] }}
                        </h3>
                        <p class="text-sm text-neutral-600">
                            {{ $category['description'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Kursus unggulan -->
    <section id="featured-courses" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-2xl md:text-3xl font-semibold text-neutral-900">
                        Kursus unggulan
                    </h2>
                    <p class="mt-2 text-sm text-neutral-600 max-w-xl">
                        Beberapa course yang paling banyak diminati dan cocok sebagai titik awal untuk membangun skill.
                    </p>
                </div>
                <a
                    href="{{ route('courses.catalog') }}"
                    class="hidden sm:inline-flex text-sm font-medium text-emerald-700 hover:text-emerald-800"
                >
                    Lihat semua kursus
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses ?? [] as $course)
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition flex flex-col">
                        <div class="aspect-video bg-neutral-200 rounded-t-lg overflow-hidden">
                            <img
                                src="https://source.unsplash.com/600x400?education,technology&sig={{ $course->id }}"
                                alt="{{ $course->name }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                        <div class="p-5 flex flex-col gap-3">
                            <div class="flex items-center justify-between gap-3">
                                <span class="inline-flex items-center rounded-md bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700">
                                    {{ $course->category->name ?? 'Umum' }}
                                </span>
                                <span class="text-[11px] text-neutral-500">
                                    {{ optional($course->start_date)->format('M Y') ?? 'Kapan saja' }}
                                </span>
                            </div>

                            <h3 class="text-base font-semibold text-neutral-900 line-clamp-2">
                                <a
                                    href="{{ route('courses.public.show', $course) }}"
                                    class="hover:text-emerald-600"
                                >
                                    {{ $course->name }}
                                </a>
                            </h3>

                            <p class="text-xs text-neutral-600 line-clamp-2">
                                {{ Str::limit($course->description, 110) }}
                            </p>

                            <div class="mt-1 flex items-center justify-between text-xs text-neutral-500">
                                <span>Oleh {{ $course->teacher->name ?? 'EduTrack' }}</span>
                                <span>{{ $course->students_count ?? 0 }} peserta</span>
                            </div>

                            <a
                                href="{{ route('courses.public.show', $course) }}"
                                class="mt-3 inline-flex items-center justify-center w-full rounded-md border border-emerald-600 px-3 py-2 text-xs font-medium text-emerald-700 hover:bg-emerald-50"
                            >
                                Lihat detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-sm text-neutral-500">
                        Belum ada kursus unggulan untuk saat ini.
                    </div>
                @endforelse
            </div>

            <div class="mt-8 text-center sm:hidden">
                <a
                    href="{{ route('courses.catalog') }}"
                    class="inline-flex text-sm font-medium text-emerald-700 hover:text-emerald-800"
                >
                    Lihat semua kursus
                </a>
            </div>
        </div>
    </section>

    <!-- Cara belajar di EduTrack -->
    <section class="py-16 bg-neutral-50 border-t border-neutral-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-2xl md:text-3xl font-semibold text-neutral-900">
                    Alur belajar yang sederhana
                </h2>
                <p class="mt-2 text-sm text-neutral-600">
                    Platform dirancang agar kamu tidak bingung harus mulai dari mana.
                    Ikuti langkah ringkas berikut untuk mulai belajar.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white border border-neutral-200 rounded-lg p-6 flex flex-col gap-2">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-50 text-emerald-700 text-sm font-semibold">
                        1
                    </span>
                    <h3 class="text-base font-semibold text-neutral-900">
                        Pilih course
                    </h3>
                    <p class="text-sm text-neutral-600">
                        Cari course yang sesuai minat dan levelmu.
                        Kamu bisa mulai dari dasar atau langsung ke topik yang spesifik.
                    </p>
                </div>
                <div class="bg-white border border-neutral-200 rounded-lg p-6 flex flex-col gap-2">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-50 text-emerald-700 text-sm font-semibold">
                        2
                    </span>
                    <h3 class="text-base font-semibold text-neutral-900">
                        Ikuti materi dan tandai progres
                    </h3>
                    <p class="text-sm text-neutral-600">
                        Baca dan tonton materi per lesson.
                        Tandai sebagai selesai agar progres belajar tercatat rapi.
                    </p>
                </div>
                <div class="bg-white border border-neutral-200 rounded-lg p-6 flex flex-col gap-2">
                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-emerald-50 text-emerald-700 text-sm font-semibold">
                        3
                    </span>
                    <h3 class="text-base font-semibold text-neutral-900">
                        Tuntaskan dan bangun portofolio
                    </h3>
                    <p class="text-sm text-neutral-600">
                        Selesaikan seluruh lesson, kerjakan tugas, dan susun portofolio hasil belajar untuk mendukung kariermu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni singkat -->
    <section class="py-16 bg-white border-t border-neutral-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm font-medium text-emerald-700 uppercase tracking-wide mb-3">
                Apa kata mereka
            </p>
            <blockquote class="text-lg text-neutral-800 leading-relaxed">
                "Platform ini membuat proses belajar terasa lebih terarah.
                Fitur progres dan pemecahan materi per lesson sangat membantu saya mengatur waktu."
            </blockquote>
            <p class="mt-4 text-sm text-neutral-600">
                Mahasiswa Sistem Informasi
            </p>
        </div>
    </section>
</x-app-layout>
