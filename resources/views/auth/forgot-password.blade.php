<x-guest-layout>
    <div class="w-full max-w-md mx-auto">
        <div class="bg-white rounded-2xl shadow-xl border border-neutral-200 p-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-amber-100 mb-6">
                    <svg class="h-10 w-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-neutral-900 mb-4">Fitur Coming Soon</h1>
                <p class="text-neutral-600 mb-6">Fitur reset password sedang dalam pengembangan. Silakan hubungi administrator untuk bantuan lebih lanjut.</p>

                <div class="bg-amber-50 border border-amber-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center justify-center">
                        <svg class="h-5 w-5 text-amber-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium text-amber-800">Fitur ini akan segera hadir!</p>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-neutral-200 text-center">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>

