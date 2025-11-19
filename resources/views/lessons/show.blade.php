<x-app-layout>
    @php
        $course = $course ?? $lesson->course;
    @endphp

    <section class="max-w-3xl mx-auto px-4 py-8 space-y-8">
        {{-- Breadcrumb sederhana --}}
        <div class="text-xs text-neutral-500 flex flex-wrap items-center gap-1">
            <a href="{{ route('home') }}" class="hover:text-neutral-800">Beranda</a>
            <span>/</span>
            @if($course)
                <a
                    href="{{ route('courses.public.show', $course) }}"
                    class="hover:text-neutral-800"
                >
                    {{ $course->name }}
                </a>
                <span>/</span>
            @endif
            <span class="text-neutral-700">Lesson</span>
        </div>

        {{-- Judul lesson --}}
        <header class="space-y-2">
            <h1 class="text-3xl md:text-4xl font-semibold text-neutral-900 leading-tight">
                {{ $lesson->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-3 text-xs text-neutral-500">
                @if($course)
                    <span>Kursus: <span class="font-medium text-neutral-700">{{ $course->name }}</span></span>
                @endif
                @if(isset($position) && isset($totalLessons))
                    <span>•</span>
                    <span>Lesson {{ $position }} dari {{ $totalLessons }}</span>
                @endif
                @if(isset($estimatedDuration))
                    <span>•</span>
                    <span>Perkiraan waktu: {{ $estimatedDuration }}</span>
                @endif
            </div>
        </header>

        {{-- Konten lesson --}}
        <article class="prose max-w-none text-base text-neutral-700 leading-relaxed">
            {!! nl2br(e($lesson->content)) !!}
        </article>

        {{-- Tombol aksi utama --}}
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 pt-4 border-t border-neutral-200">
            <form
                action="{{ route('lessons.mark.' . ($isDone ? 'not.done' : 'done'), $lesson) }}"
                method="POST"
                class="flex-1"
            >
                @csrf
                <button
                    type="submit"
                    class="w-full inline-flex items-center justify-center rounded-lg px-4 py-2.5 text-sm font-medium
                        {{ $isDone
                            ? 'bg-neutral-100 text-neutral-800 hover:bg-neutral-200'
                            : 'bg-emerald-600 text-white hover:bg-emerald-700'
                        }} shadow-sm transition"
                >
                    {{ $isDone ? 'Tandai belum selesai' : 'Tandai selesai' }}
                </button>
            </form>

            @if($nextLesson)
                <a
                    href="{{ route('lessons.show', [$course, $nextLesson]) }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center rounded-lg border border-neutral-300 px-4 py-2.5 text-sm font-medium text-neutral-800 hover:bg-neutral-50"
                >
                    {{ $isDone ? 'Lanjut ke lesson berikutnya' : 'Buka lesson berikutnya' }}
                </a>
            @endif

            @if($course)
                <a
                    href="{{ route('courses.public.show', $course) }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center rounded-lg border border-neutral-200 px-4 py-2.5 text-xs font-medium text-neutral-600 hover:bg-neutral-50"
                >
                    Kembali ke halaman kursus
                </a>
            @endif
        </div>

        {{-- Daftar materi di kursus ini --}}
        @if(isset($lessons) && $lessons->count())
            <section class="pt-6 mt-2 border-t border-neutral-200 space-y-4">
                <header class="flex items-center justify-between gap-3">
                    <div>
                        <h2 class="text-sm font-semibold text-neutral-900">
                            Daftar materi di kursus ini
                        </h2>
                        <p class="text-xs text-neutral-500">
                            Kamu bisa berpindah lesson kapan saja, progres akan tetap tercatat.
                        </p>
                    </div>
                </header>

                <div class="space-y-2">
                    @foreach($lessons as $index => $item)
                        @php
                            $number = $index + 1;
                            $current = $item->id === $lesson->id;
                            $done = $item->is_done_for_auth ?? false;
                        @endphp

                        <a
                            href="{{ route('lessons.show', [$course, $item]) }}"
                            class="flex items-center justify-between rounded-lg border
                                {{ $current ? 'border-emerald-500 bg-emerald-50/60' : 'border-neutral-200 bg-white hover:border-emerald-400 hover:bg-emerald-50/30' }}
                                px-4 py-3 text-sm transition"
                        >
                            <div class="flex items-center gap-3">
                                <div class="h-7 w-7 flex items-center justify-center rounded-full
                                    {{ $current ? 'bg-emerald-600 text-white' : 'bg-neutral-100 text-neutral-700' }}
                                    text-[11px] font-semibold"
                                >
                                    {{ $number }}
                                </div>
                                <div>
                                    <div class="font-medium {{ $current ? 'text-emerald-800' : 'text-neutral-900' }}">
                                        {{ $item->title }}
                                    </div>
                                    <div class="text-[11px] text-neutral-500">
                                        {{ $done ? 'Sudah ditandai selesai' : 'Belum ditandai' }}
                                    </div>
                                </div>
                            </div>

                            @if($done)
                                <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700">
                                    Selesai
                                </span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </section>
</x-app-layout>
