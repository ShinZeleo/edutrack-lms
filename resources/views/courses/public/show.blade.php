<x-app-layout>
    <section class="space-y-8 py-10">
        <div class="surface-card p-6 md:p-8">
            <div class="grid gap-8 md:grid-cols-[2fr,1fr]">
                <div class="space-y-4">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="badge badge-primary">{{ $course->category->name ?? 'General' }}</span>
                        <span class="badge badge-muted">{{ $course->students_count }} peserta</span>
                    </div>
                    <h1 class="text-3xl font-semibold text-neutral-900">{{ $course->name }}</h1>
                    <p class="text-sm text-neutral-500">Teacher: {{ $course->teacher->name ?? 'Belum ditetapkan' }}</p>
                    <p class="text-neutral-600 leading-relaxed">{{ $course->description }}</p>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <p class="text-xs uppercase tracking-wide text-neutral-500">Durasi</p>
                            <p class="text-sm font-semibold text-neutral-900">{{ optional($course->start_date)->format('d M Y') }} - {{ optional($course->end_date)->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-neutral-500">Lessons</p>
                            <p class="text-sm font-semibold text-neutral-900">{{ $course->lessons->count() }}</p>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-wide text-neutral-500">Status</p>
                            <p class="text-sm font-semibold text-neutral-900">{{ $course->is_active ? 'Active' : 'Inactive' }}</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl bg-gradient-to-br from-primary-600 to-primary-800 p-6 text-white">
                    <p class="text-xs uppercase tracking-[0.3em] text-white/70">Aksi</p>
                    <h2 class="mt-3 text-2xl font-semibold">{{ $isEnrolled ? 'Lanjutkan belajar' : 'Gabung course ini' }}</h2>

                    @if(isset($studentProgress))
                        <div class="mt-4">
                            <div class="progress-track bg-white/30">
                                <div class="progress-fill bg-white" style="width: {{ $studentProgress }}%"></div>
                            </div>
                            <p class="mt-2 text-sm text-white/80 text-right">{{ number_format($studentProgress, 0) }}% selesai</p>
                        </div>
                    @endif

                    <div class="mt-6 space-y-3">
                        @php $firstLesson = $course->lessons->first(); @endphp
                        @php
                            $teacherEmail = optional($course->teacher)->email;
                            $contactClasses = 'inline-flex w-full justify-center rounded-md border border-white/60 px-4 py-2 text-sm font-semibold';
                            $contactClasses .= $teacherEmail ? ' text-white' : ' text-white/60 cursor-not-allowed';
                        @endphp

                        @guest
                            <a href="{{ route('login') }}" class="btn-primary w-full justify-center">Login untuk mengikuti</a>
                        @else
                            @if(auth()->user()->isStudent())
                                @if($isEnrolled)
                                    @if($firstLesson)
                                        <a href="{{ route('lessons.show', [$course, $firstLesson]) }}" class="btn-primary w-full justify-center">Lanjutkan course</a>
                                    @else
                                        <span class="btn-secondary w-full justify-center">Lesson belum tersedia</span>
                                    @endif
                                @else
                                    <form action="{{ route('courses.enroll', $course) }}" method="POST" class="w-full">
                                        @csrf
                                        <button type="submit" class="btn-primary w-full justify-center">Ikuti course</button>
                                    </form>
                                @endif
                            @else
                                <p class="text-sm text-white/80">Login sebagai Student untuk mengikuti course.</p>
                            @endif
                        @endguest

                        <a @if($teacherEmail) href="mailto:{{ $teacherEmail }}" @endif class="{{ $contactClasses }}" @if(!$teacherEmail) aria-disabled="true" @endif>
                            Hubungi teacher
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-[2fr,1fr]">
            <div class="surface-card p-6">
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Materi pelajaran</p>
                <h2 class="mt-2 text-2xl font-semibold">Daftar lesson</h2>
                <p class="text-sm text-neutral-500">{{ $course->lessons->count() }} lesson untuk menyelesaikan course ini.</p>

                <ol class="mt-6 space-y-3">
                    @php $showLessonStatus = auth()->check() && auth()->user()->isStudent(); @endphp
                    @foreach($course->lessons as $index => $lesson)
                        @php
                            $isDoneLesson = $showLessonStatus ? ($lesson->progress->first()->is_done ?? false) : false;
                        @endphp
                        <li class="flex items-center justify-between rounded-xl border border-neutral-200 px-4 py-3">
                            <div>
                                <p class="text-sm font-semibold text-neutral-900">{{ $index + 1 }}. {{ $lesson->title }}</p>
                                <p class="text-xs text-neutral-500">Lesson {{ $index + 1 }}</p>
                            </div>
                            @if($isDoneLesson)
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-muted">Belum</span>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>

            <div class="surface-card p-6">
                <p class="text-xs uppercase tracking-[0.4em] text-primary-500">Informasi course</p>
                <ul class="mt-4 space-y-3 text-sm text-neutral-600">
                    <li>Kategori: {{ $course->category->name ?? 'General' }}</li>
                    <li>Teacher: {{ $course->teacher->name ?? 'Belum ditetapkan' }}</li>
                    <li>Peserta aktif: {{ $course->students_count }}</li>
                </ul>
            </div>
        </div>
    </section>
</x-app-layout>