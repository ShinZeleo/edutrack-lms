<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12 sm:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold text-neutral-900 mb-4 sm:mb-6">Katalog Kursus</h1>
                <div class="bg-white border border-neutral-200 rounded-lg shadow-sm p-4 sm:p-6">
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

        <section class="mt-8">
            @php
                $courseImages = [
                    'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1555949963-aa79dcee981c?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?w=600&h=400&fit=crop',
                    'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&h=400&fit=crop',
                ];
            @endphp
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            @forelse($courses as $index => $course)
                <div class="p-4 sm:p-6 border border-neutral-200 rounded-lg shadow-sm hover:shadow-md transition bg-white">
                    <div class="rounded-lg h-40 w-full bg-gradient-to-br from-emerald-400 to-blue-500 mb-4 overflow-hidden">
                        <img src="{{ $courseImages[$index % count($courseImages)] }}&sig={{ $course->id }}" alt="{{ $course->name }}" class="w-full h-full object-cover">
                    </div>

                    <h3 class="text-lg sm:text-xl font-semibold text-neutral-900 mb-2 line-clamp-2">
                        <a href="{{ route('courses.public.show', $course) }}" class="hover:text-emerald-600 transition">
                            {{ $course->name }}
                        </a>
                    </h3>

                    <p class="text-sm text-neutral-600 mb-3 sm:mb-4">
                        Oleh {{ $course->teacher->name ?? 'EduTrack' }}
                    </p>

                    @auth
                        @if(auth()->user()->isStudent() && $course->students->contains(auth()->user()))
                            @php $progress = $course->getProgressForUser(auth()->user()); @endphp
                            <div class="mb-4">
                                <div class="flex items-center justify-between text-xs sm:text-sm mb-2">
                                    <span class="font-medium text-neutral-700">Progress</span>
                                    <span class="font-bold text-emerald-600">{{ number_format($progress, 0) }}%</span>
                                </div>
                                <div class="w-full bg-neutral-200 rounded-full h-2.5">
                                    <div class="bg-emerald-600 h-2.5 rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                        @endif
                    @endauth

                    @auth
                        @if(auth()->user()->isStudent() && $course->students->contains(auth()->user()))
                            <a href="{{ route('courses.public.show', $course) }}" class="block w-full text-center bg-emerald-600 text-white px-4 py-2.5 rounded-lg hover:bg-emerald-700 transition text-sm font-semibold shadow-sm hover:shadow-md">
                                Lanjutkan
                            </a>
                        @else
                            <a href="{{ route('courses.public.show', $course) }}" class="block w-full text-center bg-emerald-600 text-white px-4 py-2.5 rounded-lg hover:bg-emerald-700 transition text-sm font-semibold shadow-sm hover:shadow-md">
                                Ikuti
                            </a>
                        @endif
                    @else
                        <a href="{{ route('courses.public.show', $course) }}" class="block w-full text-center bg-emerald-600 text-white px-4 py-2.5 rounded-lg hover:bg-emerald-700 transition text-sm font-semibold shadow-sm hover:shadow-md">
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

        @if($courses->hasPages())
            <div class="mt-8 sm:mt-12">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-4">
                    <div class="text-sm text-neutral-600 order-2 sm:order-1">
                        Menampilkan <span class="font-semibold text-neutral-900">{{ $courses->firstItem() }}</span> sampai <span class="font-semibold text-neutral-900">{{ $courses->lastItem() }}</span> dari <span class="font-semibold text-neutral-900">{{ $courses->total() }}</span> hasil
                    </div>
                </div>
                <div class="flex justify-center">
                    {{ $courses->links('vendor.pagination.tailwind') }}
                </div>
            </div>
        @endif
        </div>
    </div>
</x-app-layout>
