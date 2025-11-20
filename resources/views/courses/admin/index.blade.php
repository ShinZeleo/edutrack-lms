<x-app-layout>
    <div class="bg-gradient-to-b from-neutral-50 to-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                <div>
                    <p class="text-sm font-semibold text-emerald-600 uppercase tracking-wide mb-1">Admin</p>
                    <h1 class="text-4xl font-bold text-neutral-900">Semua Kursus</h1>
                </div>
                <a href="{{ route('admin.courses.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 font-semibold shadow-lg transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Kursus
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 rounded-xl border-2 border-green-200 bg-green-50 px-6 py-4 text-green-800 font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
            <div class="bg-white rounded-2xl shadow-lg border border-neutral-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-neutral-50 border-b border-neutral-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Teacher</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-neutral-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-200">
                            @forelse($courses as $course)
                                <tr class="hover:bg-neutral-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-neutral-900">{{ $course->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-neutral-600">
                                        {{ $course->category->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-neutral-600">
                                        {{ $course->teacher->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-neutral-600">
                                        @if($course->start_date && $course->end_date)
                                            {{ $course->start_date->format('d M Y') }} - {{ $course->end_date->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $course->is_active ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-700' }}">
                                            {{ $course->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('admin.courses.edit', $course) }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-semibold transition">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.courses.destroy', $course) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kursus ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-semibold transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-neutral-500">
                                        <svg class="h-12 w-12 mx-auto text-neutral-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                        <p>Belum ada kursus.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if(isset($courses) && method_exists($courses, 'hasPages') && $courses->hasPages())
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
