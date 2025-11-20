<x-app-layout>
    @php
        $course = $course ?? $lesson->course;
    @endphp

    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Breadcrumb --}}
            <nav class="mb-6 text-sm text-neutral-600 flex flex-wrap items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-emerald-600 transition flex items-center gap-1">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Beranda
                </a>
                <span>/</span>
                @if($course)
                    <a href="{{ route('courses.public.show', $course) }}" class="hover:text-emerald-600 transition">
                        {{ $course->name }}
                    </a>
                    <span>/</span>
                @endif
                <span class="text-neutral-900 font-medium">Lesson</span>
            </nav>

            {{-- Header --}}
            <header class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8 mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 leading-tight mb-4">
                    {{ $lesson->title }}
                </h1>

                {{-- Progress Bar --}}
                @if(isset($position) && isset($totalLessons))
                    <div class="mb-4">
                        <div class="flex items-center justify-between text-sm text-neutral-600 mb-2">
                            <span>Progress: Lesson {{ $position }} dari {{ $totalLessons }}</span>
                            <span>{{ round(($position / $totalLessons) * 100) }}%</span>
                        </div>
                        <div class="w-full bg-neutral-200 rounded-full h-2">
                            <div class="bg-emerald-600 h-2 rounded-full transition-all duration-300" style="width: {{ ($position / $totalLessons) * 100 }}%"></div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-wrap items-center gap-4 text-sm text-neutral-600">
                    @if($course)
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="font-medium">{{ $course->name }}</span>
                        </div>
                    @endif
                    @if(isset($estimatedDuration))
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $estimatedDuration }}</span>
                        </div>
                    @endif
                </div>
            </header>

            {{-- Content --}}
            <article class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-8 mb-8 prose prose-lg max-w-none">
                <div class="text-base text-neutral-700 leading-relaxed">
                    {!! nl2br(e($lesson->content)) !!}
                </div>
            </article>

            {{-- Action Bar --}}
            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 p-6">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                    <form
                        action="{{ route('lessons.mark.' . ($isDone ?? false ? 'not.done' : 'done'), $lesson) }}"
                        method="POST"
                        class="flex-1"
                    >
                        @csrf
                        <button
                            type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-xl px-6 py-3 text-sm font-semibold
                                {{ ($isDone ?? false)
                                    ? 'bg-neutral-100 text-neutral-800 hover:bg-neutral-200'
                                    : 'bg-emerald-600 text-white hover:bg-emerald-700'
                                }} shadow-sm hover:shadow-md transition"
                        >
                            @if($isDone ?? false)
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Tandai Belum Selesai
                            @else
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Tandai Selesai
                            @endif
                        </button>
                    </form>

                    @if(isset($nextLesson) && $nextLesson)
                        <a
                            href="{{ route('lessons.show', [$course, $nextLesson]) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-emerald-600 px-6 py-3 text-sm font-semibold text-emerald-700 hover:bg-emerald-50 transition"
                        >
                            Next Lesson
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @endif

                    @if($course)
                        <a
                            href="{{ route('courses.public.show', $course) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-neutral-300 px-6 py-3 text-sm font-semibold text-neutral-700 hover:bg-neutral-50 transition"
                        >
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                    @endif
                </div>
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
