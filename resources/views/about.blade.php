@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-neutral-900 mb-8 text-center">Tentang EduTrack LMS</h1>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-800 mb-4">Sejarah Kami</h2>
            <p class="text-neutral-600 mb-4">
                EduTrack LMS adalah sistem manajemen pembelajaran komprehensif yang dirancang untuk merevolusi
                cara pendidikan disampaikan dan diakses di era digital. Platform kami menjembatani kesenjangan
                antara pendidik dan pembelajar, menyediakan lingkungan yang intuitif untuk berbagi pengetahuan
                dan pengembangan keterampilan.
            </p>

            <p class="text-neutral-600">
                Didirikan dengan misi untuk mendemokratisasi pendidikan dan membuat pembelajaran berkualitas
                dapat diakses oleh semua orang, EduTrack LMS menggabungkan teknologi modern dengan prinsip
                pedagogi yang kuat untuk menciptakan pengalaman belajar yang efektif dan menarik.
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold text-neutral-800 mb-4">Misi Kami</h2>
            <p class="text-neutral-600 mb-4">
                Misi kami adalah memberdayakan pendidik dan siswa melalui teknologi pembelajaran inovatif
                yang meningkatkan pengalaman pendidikan. Kami berusaha menciptakan platform inklusif
                yang mendukung berbagai gaya belajar dan memfasilitasi hasil pendidikan yang bermakna.
            </p>

            <ul class="list-disc pl-6 text-neutral-600 space-y-2">
                <li>Menyediakan pendidikan berkualitas yang dapat diakses oleh pembelajar di seluruh dunia</li>
                <li>Mendukung pendidik dengan alat-alat canggih untuk pembuatan dan manajemen kursus</li>
                <li>Menciptakan pengalaman belajar yang menarik dan interaktif</li>
                <li>Mengaktifkan jalur pembelajaran yang dipersonalisasi sesuai dengan kebutuhan individu</li>
                <li>Mempromosikan pembelajaran dan pengembangan keterampilan yang berkelanjutan</li>
            </ul>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <div class="text-3xl font-bold text-emerald-600 mb-2">1000+</div>
                <div class="text-neutral-600">Siswa</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <div class="text-3xl font-bold text-emerald-600 mb-2">50+</div>
                <div class="text-neutral-600">Kursus</div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <div class="text-3xl font-bold text-emerald-600 mb-2">15+</div>
                <div class="text-neutral-600">Guru</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold text-neutral-800 mb-6">Mengapa Memilih EduTrack LMS?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start">
                    <div class="bg-emerald-100 p-2 rounded-full mr-4">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-neutral-800 mb-2">Antarmuka Ramah Pengguna</h3>
                        <p class="text-neutral-600 text-sm">Desain yang intuitif memudahkan pembelajaran dan pengajaran bagi semua orang.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-emerald-100 p-2 rounded-full mr-4">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-neutral-800 mb-2">Aman & Terpercaya</h3>
                        <p class="text-neutral-600 text-sm">Keamanan kelas perusahaan untuk melindungi data dan privasi Anda.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-emerald-100 p-2 rounded-full mr-4">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-neutral-800 mb-2">Pembelajaran Interaktif</h3>
                        <p class="text-neutral-600 text-sm">Alat dan fitur menarik yang meningkatkan pengalaman belajar.</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-emerald-100 p-2 rounded-full mr-4">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-neutral-800 mb-2">Pelacakan Progres</h3>
                        <p class="text-neutral-600 text-sm">Analitik komprehensif untuk memantau kemajuan dan hasil pembelajaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection