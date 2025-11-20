<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-neutral-900 mb-4">Semua Kursus</h1>
                <p class="text-lg text-neutral-600">Jelajahi berbagai kursus berkualitas untuk meningkatkan skill Anda</p>
            </div>

            
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6 mb-8">
                <form method="GET" action="{{ route('courses.catalog') }}" class="space-y-4 md:space-y-0 md:flex md:items-center md:gap-4">
                    
                    <div class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari kursus..."
                                class="block w-full pl-10 pr-3 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                            />
                        </div>
                    </div>

                    
                    <div class="md:w-64">
                        <select
                            name="category"
                            class="block w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm bg-white"
                        >
                            <option value="">Semua Kategori</option>
                            @foreach($categories ?? [] as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    
                    <div class="md:w-48">
                        <select
                            name="sort"
                            class="block w-full px-4 py-3 border border-neutral-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm bg-white"
                        >
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Terpopuler</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                        </select>
                    </div>

                    
                    <button
                        type="submit"
                        class="w-full md:w-auto px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition shadow-sm hover:shadow-md"
                    >
                        Cari
                    </button>
                </form>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @forelse($courses as $course)
                    <div class="bg-white border-2 border-neutral-200 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="aspect-video bg-gradient-to-br from-emerald-400 to-blue-500 overflow-hidden relative">
                            <img
                                src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop&sig={{ $course->id }}"
                                alt="{{ $course->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300"
                            />
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center rounded-lg bg-white/90 backdrop-blur px-3 py-1 text-xs font-semibold text-emerald-700 shadow-sm">
                                    {{ $course->category->name ?? 'Umum' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-neutral-900 line-clamp-2 mb-2 group-hover:text-emerald-600 transition">
                                    <a href="{{ route('courses.public.show', $course) }}">
                                        {{ $course->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-neutral-600 line-clamp-2">
                                    {{ Str::limit($course->description, 100) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center gap-2 text-neutral-600">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class="font-medium">{{ $course->teacher->name ?? 'EduTrack' }}</span>
                                </div>
                                <div class="flex items-center gap-1 text-neutral-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>{{ $course->students_count ?? 0 }}</span>
                                </div>
                            </div>

                            <a
                                href="{{ route('courses.public.show', $course) }}"
                                class="mt-2 inline-flex items-center justify-center gap-2 w-full rounded-lg bg-emerald-600 px-4 py-3 text-sm font-semibold text-white hover:bg-emerald-700 transition shadow-sm hover:shadow-md"
                            >
                                Lihat Kursus
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="h-20 w-20 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="text-xl font-semibold text-neutral-900 mb-2">Tidak ada kursus ditemukan</h3>
                        <p class="text-neutral-600 mb-6">Coba ubah filter atau kata kunci pencarian Anda.</p>
                        <a
                            href="{{ route('courses.catalog') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition"
                        >
                            Lihat Semua Kursus
                        </a>
                    </div>
                @endforelse
            </div>

            
            @if(isset($courses) && method_exists($courses, 'links'))
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
