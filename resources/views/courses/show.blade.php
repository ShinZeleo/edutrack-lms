<x-app-layout>
    <section class="pt-6 pb-10">
        <div class="grid gap-8 lg:grid-cols-[minmax(0,2fr)_minmax(0,1fr)]">
            <div class="space-y-6">
                <div class="space-y-3">
                    <span class="inline-flex items-center rounded-md bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700">
                        {{ $course->category->name ?? 'Umum' }}
                    </span>

                    <h1 class="text-3xl md:text-4xl font-semibold text-neutral-900 leading-tight">
                        {{ $course->name }}
                    </h1>

                    <div class="text-sm text-neutral-600 flex flex-wrap items-center gap-2">
                        <span>Oleh <span class="font-medium">{{ $course->teacher->name ?? 'EduTrack' }}</span></span>
                        <span class="h-1 w-1 rounded-full bg-neutral-400"></span>
                        <span>{{ $course->students_count ?? 0 }} peserta terdaftar</span>
                        <span class="h-1 w-1 rounded-full bg-neutral-400"></span>
                        <span>{{ $lessons->count() }} lesson</span>
                    </div>
                </div>

                <div class="aspect-video w-full rounded-xl bg-neutral-200 overflow-hidden">
                    <img
                        src="https://source.unsplash.com/1200x675?learning,online&sig={{ $course->id }}"
                        alt="{{ $course->name }}"
                        class="w-full h-full object-cover"
                    >
                </div>

                <div class="space-y-3">
                    <h2 class="text-xl font-semibold text-neutral-900">
                        Deskripsi kursus
                    </h2>
                    <p class="text-sm text-neutral-700 leading-relaxed whitespace-pre-line">
                        {{ $course->description }}
                    </p>
                </div>

                <div class="space-y-3">
                    <h2 class="text-xl font-semibold text-neutral-900">
                        Daftar materi
                    </h2>

                    @if($lessons->count())
                        <div class="space-y-2">
                            @foreach($lessons as $index => $lesson)
                                @php
                                    $number = $index + 1;
                                    $isDone = $lesson->is_done_for_auth ?? false;
                                @endphp
                                <a
                                    href="{{ route('lessons.show', [$course, $lesson]) }}"
                                    class="flex items-center justify-between rounded-lg border border-neutral-200 bg-white px-4 py-3 text-sm hover:border-emerald-500 hover:bg-emerald-50/40 transition"
                                >
                                    <div class="flex items-center gap-3">
                                        <div class="h-7 w-7 flex items-center justify-center rounded-full bg-neutral-100 text-[11px] font-medium text-neutral-700">
                                            {{ $number }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-neutral-900">
                                                {{ $lesson->title }}
                                            </div>
                                            <div class="text-[11px] text-neutral-500">
                                                {{ $lesson->estimated_duration ?? 'Lesson' }} {{ $isDone ? '• Selesai' : '' }}
                                            </div>
                                        </div>
                                    </div>
                                    @if($isDone)
                                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700">
                                            Selesai
                                        </span>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-neutral-500">
                            Belum ada materi yang tersedia untuk kursus ini.
                        </p>
                    @endif
                </div>
            </div>

            <aside class="space-y-4">
                <div class="bg-white border border-neutral-200 rounded-xl shadow-sm p-5 space-y-4">
                    <div>
                        <p class="text-xs text-neutral-500 uppercase tracking-wide mb-1">
                            Status kursus
                        </p>
                        <p class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700">
                            {{ $course->is_active ? 'Aktif' : 'Tidak aktif' }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-1 text-sm text-neutral-700">
                        <div class="flex items-center justify-between">
                            <span>Mulai</span>
                            <span class="font-medium">
                                {{ optional($course->start_date)->format('d M Y') ?? '-' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Selesai</span>
                            <span class="font-medium">
                                {{ optional($course->end_date)->format('d M Y') ?? '-' }}
                            </span>
                        </div>
                    </div>

                    @auth
                        @if(Auth::user()->role === 'student')
                            <form
                                method="POST"
                                action="{{ route('courses.enroll', $course) }}"
                                class="space-y-2"
                            >
                                @csrf
                                @if($isEnrolled ?? false)
                                    <button
                                        type="button"
                                        disabled
                                        class="w-full inline-flex items-center justify-center rounded-lg bg-neutral-100 px-4 py-2.5 text-sm font-medium text-neutral-600"
                                    >
                                        Sudah terdaftar
                                    </button>

                                    @if(isset($progressPercent))
                                        <div class="w-full">
                                            <div class="h-2 rounded-full bg-neutral-200">
                                                <div
                                                    class="h-2 rounded-full bg-emerald-600"
                                                    style="width: {{ $progressPercent }}%;"
                                                ></div>
                                            </div>
                                            <div class="mt-1 text-[11px] text-neutral-600 text-right">
                                                Progres {{ $progressPercent }}%
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    <button
                                        type="submit"
                                        class="w-full inline-flex items-center justify-center rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-emerald-700 shadow-sm"
                                    >
                                        Ikuti kursus ini
                                    </button>
                                @endif
                            </form>
                        @endif
                    @endauth

                    @guest
                        <a
                            href="{{ route('login') }}"
                            class="w-full inline-flex items-center justify-center rounded-lg bg-emerald-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-emerald-700 shadow-sm"
                        >
                            Login untuk mengikuti kursus
                        </a>
                    @endguest

                    <div class="pt-2 border-t border-neutral-200 mt-2">
                        <p class="text-xs text-neutral-500 uppercase tracking-wide mb-2">
                            Hubungi teacher
                        </p>
                        <a
                            href="#"
                            class="inline-flex items-center gap-2 text-sm text-emerald-700 hover:text-emerald-800"
                        >
                            <span>Diskusikan kursus ini</span>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </section>
</x-app-layout>
