<x-app-layout>
    <section class="py-10 space-y-6">
        <nav class="text-sm text-neutral-500">
            <a href="{{ route('home') }}" class="hover:text-neutral-700">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('courses.public.show', $course) }}" class="hover:text-neutral-700">{{ $course->name }}</a>
            <span class="mx-1">/</span>
            <span class="text-neutral-700">{{ $lesson->title }}</span>
        </nav>

        <div class="grid gap-6 lg:grid-cols-[2fr,1fr]">
            <article class="surface-card p-6 space-y-6">
                <header class="border-b border-neutral-200 pb-4">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-xs uppercase tracking-wide text-neutral-500">Lesson {{ $lesson->order + 1 }}</p>
                            <h1 class="text-2xl font-semibold text-neutral-900">{{ $lesson->title }}</h1>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-neutral-500">Progress course</p>
                            <div class="progress-track w-48">
                                <div class="progress-fill" style="width: {{ $courseProgress }}%"></div>
                            </div>
                            <p class="text-xs text-neutral-500">{{ number_format($courseProgress, 0) }}% selesai</p>
                        </div>
                    </div>
                </header>

                <div class="prose max-w-none">
                    {!! nl2br(e($lesson->content)) !!}
                </div>

                <div class="rounded-2xl border border-neutral-200 bg-neutral-50 p-4">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold text-neutral-900">Status lesson</p>
                            <p class="text-xs text-neutral-500">{{ $isDone ? 'Materi sudah ditandai selesai.' : 'Tandai selesai sebelum lanjut.' }}</p>
                        </div>
                        <div class="flex flex-wrap items-center gap-3">
                            <form action="{{ route('lessons.mark.' . ($isDone ? 'not.done' : 'done'), $lesson) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-primary text-xs">
                                    {{ $isDone ? 'Tandai belum selesai' : 'Mark as done' }}
                                </button>
                            </form>

                            @if($nextLesson)
                                @if($isDone)
                                    <a href="{{ route('lessons.show', [$course, $nextLesson]) }}" class="btn-secondary text-xs">Lanjutkan →</a>
                                @else
                                    <button class="btn-secondary text-xs opacity-50" disabled>Tandai selesai untuk lanjut</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    @if($prevLesson)
                        <a href="{{ route('lessons.show', [$course, $prevLesson]) }}" class="text-sm font-semibold text-primary-600">← Lesson sebelumnya</a>
                    @endif
                    <a href="{{ route('courses.public.show', $course) }}" class="text-sm text-neutral-500">Kembali ke detail course</a>
                </div>
            </article>

            <aside class="surface-card p-6">
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Daftar lesson</p>
                <ol class="mt-4 space-y-3 text-sm text-neutral-600">
                    @foreach($course->lessons as $item)
                        @php $done = $item->progress->first()->is_done ?? false; @endphp
                        <li class="flex items-center justify-between rounded-xl border px-3 py-2 {{ $item->id === $lesson->id ? 'border-primary-300 bg-primary-50' : 'border-neutral-200' }}">
                            <div>
                                <p class="font-semibold text-neutral-900">{{ $item->title }}</p>
                                <p class="text-xs text-neutral-500">Lesson {{ $item->order + 1 }}</p>
                            </div>
                            <span class="text-xs font-semibold {{ $done ? 'text-success-600' : 'text-neutral-400' }}">{{ $done ? '✔' : '•' }}</span>
                        </li>
                    @endforeach
                </ol>
            </aside>
        </div>
    </section>
</x-app-layout>