<x-app-layout>
    @section('title', 'Semua Kursus')

    <section class="pt-6 pb-10">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-semibold text-neutral-900">
                    Semua kursus
                </h1>
                <p class="mt-2 text-sm text-neutral-600 max-w-xl">
                    Jelajahi kursus yang tersedia. Gunakan pencarian dan filter kategori untuk menemukan materi yang sesuai dengan kebutuhanmu.
                </p>
            </div>

            <form method="GET" action="{{ route('courses.catalog') }}" class="w-full md:w-auto">
                <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
                    <div class="relative flex-1">
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari kursus..."
                            class="w-full rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm text-neutral-800 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                        <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-neutral-400">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                                <path d="M9.5 4a5.5 5.5 0 1 1 0 11" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="m13.5 13.5 2 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </div>

                    <select
                        name="category"
                        class="w-full sm:w-48 rounded-lg border border-neutral-300 bg-white px-3 py-2 text-sm text-neutral-800 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                    >
                        <option value="">Semua kategori</option>
                        @foreach($categories ?? [] as $category)
                            <option
                                value="{{ $category->id }}"
                                @selected(request('category') == $category->id)
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        @if(($courses ?? collect())->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($courses as $course)
                    <div class="bg-white border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition flex flex-col">
                        <div class="aspect-video bg-neutral-200 rounded-t-lg overflow-hidden">
                            <img
                                src="https://source.unsplash.com/600x400?online,course&sig={{ $course->id }}"
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
                                    {{ $course->is_active ? 'Aktif' : 'Tidak aktif' }}
                                </span>
                            </div>

                            <h2 class="text-base font-semibold text-neutral-900 line-clamp-2">
                                <a
                                    href="{{ route('courses.public.show', $course) }}"
                                    class="hover:text-emerald-600"
                                >
                                    {{ $course->name }}
                                </a>
                            </h2>

                            <p class="text-xs text-neutral-600 line-clamp-2">
                                {{ Str::limit($course->description, 120) }}
                            </p>

                            <div class="mt-1 flex items-center justify-between text-xs text-neutral-500">
                                <span>Oleh {{ $course->teacher->name ?? 'EduTrack' }}</span>
                                <span>{{ $course->students_count ?? 0 }} peserta</span>
                            </div>

                            <div class="flex flex-col gap-2 mt-2">
                                @auth
                                    @if(Auth::user()->role === 'student' && $course->pivot?->enrolled_at)
                                        {{-- contoh indikator progress, sesuaikan dengan logika kamu --}}
                                        @php
                                            $progress = isset($course->progress_percent)
                                                ? $course->progress_percent
                                                : 0;
                                        @endphp
                                        <div class="w-full">
                                            <div class="h-2 rounded-full bg-neutral-200">
                                                <div
                                                    class="h-2 rounded-full bg-emerald-600"
                                                    style="width: {{ $progress }}%;"
                                                ></div>
                                            </div>
                                            <div class="mt-1 text-[11px] text-neutral-600 text-right">
                                                Progres {{ $progress }}%
                                            </div>
                                        </div>
                                        <a
                                            href="{{ route('courses.public.show', $course) }}"
                                            class="inline-flex items-center justify-center w-full rounded-md border border-emerald-600 px-3 py-2 text-xs font-medium text-emerald-700 hover:bg-emerald-50"
                                        >
                                            Lanjutkan belajar
                                        </a>
                                    @else
                                        <a
                                            href="{{ route('courses.public.show', $course) }}"
                                            class="inline-flex items-center justify-center w-full rounded-md border border-emerald-600 px-3 py-2 text-xs font-medium text-emerald-700 hover:bg-emerald-50"
                                        >
                                            Lihat detail kursus
                                        </a>
                                    @endif
                                @endauth

                                @guest
                                    <a
                                        href="{{ route('login') }}"
                                        class="inline-flex items-center justify-center w-full rounded-md border border-neutral-300 px-3 py-2 text-xs font-medium text-neutral-700 hover:bg-neutral-50"
                                    >
                                        Login untuk mengikuti
                                    </a>
                                @endguest
                            </div>

                            <div class="mt-2 flex items-center justify-between text-[11px] text-neutral-500">
                                <a
                                    href="#"
                                    class="inline-flex items-center gap-1 text-emerald-700 hover:text-emerald-800"
                                >
                                    Hubungi teacher
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $courses->withQueryString()->links() }}
            </div>
        @else
            <div class="py-10 text-center text-sm text-neutral-500">
                Tidak ada kursus yang ditemukan. Coba ubah kata kunci atau filter.
            </div>
        @endif
    </section>
</x-app-layout>
