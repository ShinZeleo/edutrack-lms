<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-neutral-900 mb-2">Halo, {{ Auth::user()->name }}!</h1>
                    <p class="text-lg text-neutral-600">Kelola kursus dan pantau perkembangan siswa Anda</p>
                </div>
                <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold shadow-lg hover:shadow-xl transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Kursus Baru
                </a>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-600 mb-1">Total Kursus</p>
                            <p class="text-3xl font-bold text-emerald-600">{{ $courses->total() ?? 0 }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-emerald-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-600 mb-1">Total Siswa</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $courses->sum('students_count') ?? 0 }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-neutral-600 mb-1">Kursus Aktif</p>
                            <p class="text-3xl font-bold text-purple-600">{{ $courses->where('is_active', true)->count() }}</p>
                        </div>
                        <div class="h-12 w-12 rounded-full bg-purple-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-neutral-900 mb-6">Kursus Saya</h2>

                @if($courses->count() > 0)
                    <div class="bg-white rounded-xl shadow-lg border border-neutral-200 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-neutral-50 border-b border-neutral-200">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Nama Kursus</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Jumlah Siswa</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-neutral-200">
                                    @foreach($courses as $course)
                                        <tr class="hover:bg-neutral-50 transition">
                                            <td class="px-6 py-4">
                                                <div class="font-semibold text-neutral-900">{{ $course->name }}</div>
                                                <div class="text-sm text-neutral-500">{{ $course->category->name ?? 'Umum' }}</div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2 text-neutral-700">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                    </svg>
                                                    <span class="font-medium">{{ $course->students_count ?? 0 }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold {{ $course->is_active ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-700' }}">
                                                    <span class="h-1.5 w-1.5 rounded-full {{ $course->is_active ? 'bg-green-500' : 'bg-neutral-400' }}"></span>
                                                    {{ $course->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    <a href="{{ route('teacher.courses.edit', $course) }}" class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-semibold transition">
                                                        Edit
                                                    </a>
                                                    <a href="{{ route('teacher.courses.lessons.index', $course) }}" class="px-3 py-1.5 border-2 border-emerald-600 text-emerald-700 rounded-lg hover:bg-emerald-50 text-sm font-semibold transition">
                                                        Lesson
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-lg border border-neutral-200 p-12 text-center">
                        <svg class="h-20 w-20 mx-auto text-neutral-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <h3 class="text-xl font-semibold text-neutral-900 mb-2">Belum ada kursus</h3>
                        <p class="text-neutral-600 mb-6">Mulai dengan membuat kursus pertama Anda.</p>
                        <a href="{{ route('teacher.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold transition shadow-sm">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Kursus Pertama
                        </a>
                    </div>
                @endif
            </div>

            
            @if(isset($courses) && method_exists($courses, 'hasPages') && $courses->hasPages())
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>


