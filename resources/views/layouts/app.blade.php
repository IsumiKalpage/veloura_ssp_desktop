<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind / Vite -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Font Awesome (for social + nav icons) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-pQnS3g2uQq5lqFZ7R3S0lDZgRZCIt/87n8kPrFmMUBP6z7mF+S4bkR0E8OHDKp2FjM4qmsB8ZayYVr5n3Kx6Jw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- Livewire Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            {{-- 🔹 Removed Jetstream default navigation and header --}}
            {{-- @livewire('navigation-menu') --}}

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
