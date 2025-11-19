<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-neutral-900 antialiased bg-neutral-50">
        <div class="min-h-screen flex flex-col items-center justify-center pt-6 sm:pt-0">
            <div class="w-full max-w-md mx-auto mt-24 p-10 bg-white border border-neutral-200 rounded-xl shadow-lg">
                <div class="text-center mb-6">
                    <a href="/" class="inline-block font-bold text-2xl text-neutral-900 mb-2">EduTrack</a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
