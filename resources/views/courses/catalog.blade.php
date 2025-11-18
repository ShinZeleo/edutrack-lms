<x-app-layout>
    <!-- Header -->
    <div class="py-8">
        <h1 class="text-4xl font-bold tracking-tight text-neutral-900">Katalog Kursus</h1>
        <p class="mt-2 text-lg text-neutral-600">Jelajahi seluruh kursus yang tersedia di platform untuk memulai perjalanan belajar Anda.</p>
    </div>

    <!-- Filters -->
    <section class="mb-8">
        <div class="bg-white p-6 rounded-lg border border-neutral-200 shadow-sm">
            <form method="GET" action="{{ route('courses.catalog') }}" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 items-end">
                <div>
                    <x-input-label for="search" value="Pencarian" />
                    <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" value="{{ request('search') }}" placeholder="Nama kursus atau mentor..." />
                </div>
                <div>
                    <x-input-label for="category_id" value="Kategori" />
                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-xl border-neutral-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="sort" value="Urutkan" />
                    <select id="sort" name="sort" class="mt-1 block w-full rounded-xl border-neutral-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                        <option value="latest" @selected(($sort ?? request('sort', 'latest')) === 'latest')>Terbaru</option>
                        <option value="popular" @selected(($sort ?? request('sort')) === 'popular')>Terpopuler</option>
                        @auth
                            <option value="progress" @selected(($sort ?? request('sort')) === 'progress')>Progress Tertinggi</option>
                        @endauth
                    </select>
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button class="w-full justify-center">Terapkan</x-primary-button>
                    @if(request()->hasAny(['search','category_id','sort']))
                        <a href="{{ route('courses.catalog') }}" class="text-sm font-medium text-neutral-600 hover:text-neutral-900">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </section>

    <!-- Courses Grid -->
    <section>
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @forelse($courses as $course)
                <div class="group relative flex flex-col rounded-xl border border-neutral-200 bg-white shadow-sm">
                    <div class="aspect-h-3 aspect-w-4 bg-neutral-200 sm:aspect-none sm:h-48">
                        <img src="https://source.unsplash.com/random/600x400?education&sig={{ $course->id }}" alt="{{ $course->name }}" class="h-full w-full object-cover object-center sm:h-full sm:w-full">
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
                        @auth
                            @if(auth()->user()->isStudent() && $course->students->contains(auth()->user()))
                                @php $progress = $course->getProgressForUser(auth()->user()); @endphp
                                <div class="pt-2">
                                    <div class="w-full bg-neutral-200 rounded-full h-2">
                                        <div class="bg-primary-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <p class="mt-1 text-right text-xs text-neutral-500">{{ number_format($progress, 0) }}% selesai</p>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-24">
                    <h3 class="text-lg font-medium text-neutral-800">Tidak Ada Kursus Ditemukan</h3>
                    <p class="text-neutral-600 mt-1">Coba sesuaikan filter pencarian Anda.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $courses->links() }}
    </div>
</x-app-layout>