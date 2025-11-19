<x-app-layout>
    @php
        $user = Auth::user();
    @endphp

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-neutral-900">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="space-y-8">
            <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white border border-neutral-200 rounded-xl shadow-sm p-4">
                    <p class="text-xs text-neutral-500 uppercase tracking-wide">
                        Selamat datang
                    </p>
                    <p class="mt-1 text-base font-semibold text-neutral-900">
                        {{ $user->name }}
                    </p>
                    <p class="mt-1 text-xs text-neutral-600">
                        Role: <span class="font-medium capitalize">{{ $user->role ?? 'user' }}</span>
                    </p>
                </div>

                @if(isset($stats))
                    @foreach($stats as $label => $value)
                        <div class="bg-white border border-neutral-200 rounded-xl shadow-sm p-4">
                            <p class="text-xs text-neutral-500 uppercase tracking-wide">
                                {{ $label }}
                            </p>
                            <p class="mt-2 text-2xl font-semibold text-neutral-900">
                                {{ $value }}
                            </p>
                        </div>
                    @endforeach
                @endif
            </section>

            @if($user->role === 'student')
                <section class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-neutral-900">
                            Kursus yang sedang kamu ikuti
                        </h3>
                        <a
                            href="{{ route('courses.catalog') }}"
                            class="text-sm text-emerald-700 hover:text-emerald-800"
                        >
                            Jelajahi kursus lain
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($enrolledCourses ?? [] as $course)
                            @php
                                $progress = $course->progress_percent ?? 0;
                            @endphp
                            <div class="bg-white border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition flex flex-col">
                                <div class="p-5 flex flex-col gap-3">
                                    <h4 class="text-base font-semibold text-neutral-900">
                                        {{ $course->name }}
                                    </h4>
                                    <p class="text-xs text-neutral-600 line-clamp-2">
                                        {{ Str::limit($course->description, 120) }}
                                    </p>
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
                                        class="mt-2 inline-flex items-center justify-center w-full rounded-md border border-emerald-600 px-3 py-2 text-xs font-medium text-emerald-700 hover:bg-emerald-50"
                                    >
                                        Lanjutkan belajar
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-neutral-500">
                                Kamu belum mengikuti kursus apa pun. Mulai dari memilih satu kursus di katalog.
                            </p>
                        @endforelse
                    </div>
                </section>
            @elseif($user->role === 'teacher')
                <section class="space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-neutral-900">
                            Kursus yang kamu ajar
                        </h3>
                        <a
                            href="{{ route('teacher.courses.create') }}"
                            class="text-sm text-emerald-700 hover:text-emerald-800"
                        >
                            Buat kursus baru
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($teacherCourses ?? [] as $course)
                            <div class="bg-white border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition flex flex-col">
                                <div class="p-5 flex flex-col gap-2">
                                    <h4 class="text-base font-semibold text-neutral-900">
                                        {{ $course->name }}
                                    </h4>
                                    <p class="text-xs text-neutral-600 line-clamp-2">
                                        {{ Str::limit($course->description, 120) }}
                                    </p>
                                    <p class="text-[11px] text-neutral-500 mt-1">
                                        {{ $course->students_count ?? 0 }} siswa terdaftar
                                    </p>
                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <a
                                            href="{{ route('teacher.courses.edit', $course) }}"
                                            class="inline-flex items-center justify-center rounded-md border border-neutral-300 px-3 py-1.5 text-xs font-medium text-neutral-700 hover:bg-neutral-50"
                                        >
                                            Edit kursus
                                        </a>
                                        <a
                                            href="{{ route('teacher.courses.show', $course) }}"
                                            class="inline-flex items-center justify-center rounded-md border border-emerald-600 px-3 py-1.5 text-xs font-medium text-emerald-700 hover:bg-emerald-50"
                                        >
                                            Detail dan materi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-neutral-500">
                                Kamu belum membuat course. Mulai dengan membuat satu course terlebih dahulu.
                            </p>
                        @endforelse
                    </div>
                </section>
            @elseif($user->role === 'admin')
                <section class="space-y-4">
                    <h3 class="text-lg font-semibold text-neutral-900">
                        Administrasi platform
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a
                            href="{{ route('admin.users.index') }}"
                            class="bg-white border border-neutral-200 rounded-lg shadow-sm p-4 flex flex-col gap-1 hover:border-emerald-500 hover:shadow-md transition"
                        >
                            <span class="text-sm font-semibold text-neutral-900">
                                Manajemen user
                            </span>
                            <span class="text-xs text-neutral-600">
                                Kelola admin, teacher, dan student.
                            </span>
                        </a>
                        <a
                            href="{{ route('admin.courses.index') }}"
                            class="bg-white border border-neutral-200 rounded-lg shadow-sm p-4 flex flex-col gap-1 hover:border-emerald-500 hover:shadow-md transition"
                        >
                            <span class="text-sm font-semibold text-neutral-900">
                                Manajemen kursus
                            </span>
                            <span class="text-xs text-neutral-600">
                                Pantau dan atur seluruh kursus yang tersedia.
                            </span>
                        </a>
                        <a
                            href="{{ route('admin.categories.index') }}"
                            class="bg-white border border-neutral-200 rounded-lg shadow-sm p-4 flex flex-col gap-1 hover:border-emerald-500 hover:shadow-md transition"
                        >
                            <span class="text-sm font-semibold text-neutral-900">
                                Manajemen kategori
                            </span>
                            <span class="text-xs text-neutral-600">
                                Atur kategori untuk pengelompokan kursus.
                            </span>
                        </a>
                    </div>
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
