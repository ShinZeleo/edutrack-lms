<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'EduTrack') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
            rel="stylesheet"
        >

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-neutral-800 bg-neutral-50">
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="border-b border-neutral-200 bg-white">
                    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
                    @isset($slot)
                        {{ $slot }}
                    @else
                        @yield('content')
                    @endisset
                </div>
            </main>

            <footer class="border-t border-neutral-200 bg-white">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4 text-xs text-neutral-500 flex items-center justify-between">
                    <span>&copy; {{ date('Y') }} EduTrack. Semua hak dilindungi.</span>
                    <span class="hidden sm:inline">
                        Dibangun dengan Laravel dan Tailwind CSS.
                    </span>
                </div>
            </footer>
        </div>
    </body>
</html>
