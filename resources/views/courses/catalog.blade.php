<x-app-layout>
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-neutral-900 mb-6">Katalog Kursus</h1>
        <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-6">
            <form method="GET" action="{{ route('courses.catalog') }}" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 items-end">
                <div>
                    <x-input-label for="search" value="Pencarian" />
                    <x-text-input id="search" name="search" type="text" class="mt-1 block w-full rounded-lg border-neutral-300" value="{{ request('search') }}" placeholder="Cari nama kursus..." />
                </div>
                <div>
                    <x-input-label for="category_id" value="Kategori" />
                    <select id="category_id" name="category_id" class="mt-1 block w-full rounded-lg border-neutral-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button class="w-full justify-center">Cari</x-primary-button>
                    @if(request()->hasAny(['search','category_id']))
                        <a href="{{ route('courses.catalog') }}" class="text-sm font-medium text-neutral-600 hover:text-neutral-900 whitespace-nowrap">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <section>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
                <div class="p-6 border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition bg-white">
                    <div class="rounded-lg h-40 w-full bg-gradient-to-br from-emerald-400 to-blue-500 mb-4 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop&sig={{ $course->id }}" alt="{{ $course->name }}" class="w-full h-full object-cover">
                    </div>

                    <h3 class="text-xl font-semibold text-neutral-900 mb-2">
                        <a href="{{ route('courses.public.show', $course) }}" class="hover:text-emerald-600">
                            {{ $course->name }}
                        </a>
                    </h3>

                    <p class="text-sm text-neutral-600 mb-4">
                        Oleh {{ $course->teacher->name ?? 'EduTrack' }}
                    </p>

                    @auth
                        @if(auth()->user()->isStudent() && $course->students->contains(auth()->user()))
                            @php $progress = $course->getProgressForUser(auth()->user()); @endphp
                            <div class="mb-4">
                                <div class="w-full bg-neutral-200 rounded-full h-2 mb-1">
                                    <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ $progress }}%"></div>
                                </div>
                                <p class="text-xs text-neutral-500">{{ number_format($progress, 0) }}% selesai</p>
                            </div>
                        @endif
                    @endauth

                    @auth
                        @if(auth()->user()->isStudent() && $course->students->contains(auth()->user()))
                            <a href="{{ route('courses.show', $course) }}" class="block w-full text-center bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                                Lanjutkan
                            </a>
                        @else
                            <a href="{{ route('courses.public.show', $course) }}" class="block w-full text-center bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                                Ikuti
                            </a>
                        @endif
                    @else
                        <a href="{{ route('courses.public.show', $course) }}" class="block w-full text-center bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition text-sm font-medium">
                            Ikuti
                        </a>
                    @endauth
                </div>
            @empty
                <div class="col-span-full text-center py-24">
                    <h3 class="text-lg font-medium text-neutral-800">Tidak Ada Kursus Ditemukan</h3>
                    <p class="text-neutral-600 mt-1">Coba sesuaikan filter pencarian Anda.</p>
                </div>
            @endforelse
        </div>
    </section>

    <div class="mt-12">
        {{ $courses->links() }}
    </div>
</x-app-layout>
