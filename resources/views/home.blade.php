<x-app-layout>
    <div class="space-y-16 sm:space-y-24">
        <!-- Hero Section -->
        <section class="pt-8 pb-12 text-center">
            <div class="mx-auto max-w-4xl">
                <p class="inline-flex justify-center rounded-full bg-primary-100 px-4 py-1.5 text-sm font-semibold text-primary-700">
                    Platform Terbaru 2024
                </p>
                <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-neutral-900 sm:text-6xl">
                    Belajar, mengajar, dan mengelola kurikulum dalam satu <span class="text-primary-600">digital campus</span>.
                </h1>
                <p class="mt-6 text-lg leading-8 text-neutral-600">
                    EduTrack menghadirkan pengalaman LMS modern dengan katalog kursus kaya, automasi progress siswa, serta insight untuk admin dan pengajar.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="{{ route('courses.catalog') }}" class="rounded-xl bg-primary-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                        Telusuri Kursus
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="text-sm font-semibold leading-6 text-neutral-900">
                            Buat akun gratis <span aria-hidden="true">→</span>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-sm font-semibold leading-6 text-neutral-900">
                            Masuk ke dashboard <span aria-hidden="true">→</span>
                        </a>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section>
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl lg:max-w-none">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-neutral-900 sm:text-4xl">Dipercaya oleh Institusi Terdepan</h2>
                        <p class="mt-4 text-lg leading-8 text-neutral-600">Platform kami telah membantu ribuan orang untuk belajar lebih efektif.</p>
                    </div>
                    <dl class="mt-16 grid grid-cols-1 gap-x-8 gap-y-10 text-center sm:grid-cols-2 lg:grid-cols-4">
                        <div class="flex flex-col rounded-lg bg-white p-8 shadow-sm border border-neutral-200">
                            <dt class="text-sm leading-6 text-neutral-600">Kursus Aktif</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-primary-600">{{ number_format($stats['activeCourses']) }}+</dd>
                        </div>
                        <div class="flex flex-col rounded-lg bg-white p-8 shadow-sm border border-neutral-200">
                            <dt class="text-sm leading-6 text-neutral-600">Pengajar Aktif</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-primary-600">{{ number_format($stats['activeTeachers']) }}</dd>
                        </div>
                        <div class="flex flex-col rounded-lg bg-white p-8 shadow-sm border border-neutral-200">
                            <dt class="text-sm leading-6 text-neutral-600">Siswa Terdaftar</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-primary-600">{{ number_format($stats['activeStudents']) }}</dd>
                        </div>
                        <div class="flex flex-col rounded-lg bg-white p-8 shadow-sm border border-neutral-200">
                            <dt class="text-sm leading-6 text-neutral-600">Kategori</dt>
                            <dd class="order-first text-3xl font-semibold tracking-tight text-primary-600">{{ number_format($stats['activeCategories']) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <!-- Featured Courses Section -->
        <section>
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-neutral-900 sm:text-4xl">Koleksi Unggulan</h2>
                    <p class="mt-4 text-lg leading-8 text-neutral-600">Jelajahi kursus terpopuler yang paling diminati minggu ini.</p>
                </div>
                <div class="mt-16 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                    @forelse($courses as $course)
                        <div class="group relative flex flex-col rounded-xl border-neutral-200 bg-white shadow-sm">
                            <div class="aspect-h-3 aspect-w-4 bg-neutral-200 sm:aspect-none sm:h-48">
                                <img src="https://source.unsplash.com/random/600x400?technology&sig={{ $course->id }}" alt="{{ $course->name }}" class="h-full w-full object-cover object-center sm:h-full sm:w-full">
                            </div>
                            <div class="flex flex-1 flex-col space-y-4 p-6">
                                <h3 class="text-lg font-semibold text-neutral-900">
                                    <a href="{{ route('courses.public.show', $course) }}">
                                        <span aria-hidden="true" class="absolute inset-0"></span>
                                        {{ $course->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-neutral-600 flex-1">{{ Str::limit($course->description ?? 'Kursus interaktif dengan modul mendalam.', 100) }}</p>
                                <div class="flex items-center justify-between text-sm">
                                    <p class="font-medium text-neutral-700">Oleh {{ $course->teacher->name ?? 'EduTrack' }}</p>
                                    <p class="inline-flex items-center rounded-full bg-primary-100 px-3 py-1 text-xs font-medium text-primary-700">{{ $course->category->name ?? 'General' }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-neutral-500">Belum ada kursus populer untuk saat ini.</div>
                    @endforelse
                </div>
                 <div class="mt-12 text-center">
                    <a href="{{ route('courses.catalog') }}" class="rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-neutral-900 shadow-sm ring-1 ring-inset ring-neutral-300 hover:bg-neutral-50">
                        Lihat Semua Kursus <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Testimonial Section -->
        <section class="bg-white">
            <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
                <div class="mx-auto max-w-2xl lg:max-w-4xl">
                    <figure class="text-center">
                        <blockquote class="text-xl font-semibold leading-8 tracking-tight text-neutral-900 sm:text-2xl sm:leading-9">
                            <p>“Setelah migrasi ke EduTrack, onboarding pengajar baru jadi 3x lebih cepat, dan tampilan barunya membuat siswa betah menyelesaikan modul.”</p>
                        </blockquote>
                        <figcaption class="mt-10">
                            <div class="mt-4 flex items-center justify-center space-x-3 text-base">
                                <div class="font-semibold text-neutral-900">Jane Doe</div>
                                <svg viewBox="0 0 2 2" width="3" height="3" aria-hidden="true" class="fill-neutral-900">
                                    <circle cx="1" cy="1" r="1" />
                                </svg>
                                <div class="text-neutral-600">Head of Learning, Digital Academy</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section>
            <div class="mx-auto max-w-7xl px-6 py-16 sm:py-24 lg:px-8">
                <div class="relative isolate overflow-hidden rounded-2xl bg-neutral-900 px-6 py-24 text-center shadow-2xl sm:px-16">
                    <h2 class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">Siap Meluncurkan Pengalaman Baru?</h2>
                    <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-neutral-300">Bangun kampus digital yang terasa premium. Mulai dari tim kecil hingga institusi besar, EduTrack menyediakan antarmuka yang konsisten dan modern.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <a href="{{ route('register') }}" class="rounded-xl bg-white px-3.5 py-2.5 text-sm font-semibold text-neutral-900 shadow-sm hover:bg-neutral-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Get started</a>
                        <a href="#" class="text-sm font-semibold leading-6 text-white">Learn more <span aria-hidden="true">→</span></a>
                    </div>
                    <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
                        <circle cx="512" cy="512" r="512" fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)" fill-opacity="0.7" />
                        <defs>
                            <radialGradient id="827591b1-ce8c-4110-b064-7cb85a0b1217">
                                <stop stop-color="#7775D6" />
                                <stop offset="1" stop-color="#E935C1" />
                            </radialGradient>
                        </defs>
                    </svg>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
