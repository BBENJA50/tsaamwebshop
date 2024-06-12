<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>
    <link rel="icon" href="{{ asset('Accenten.svg') }}">
</head>
<body class="bg-gray-100 font-sans antialiased selection:bg-orange-500 selection:text-white">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <livewire:layout.navigation/>

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-2 mb-2 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
<!-- Footer-->
<footer class="py-3 bg-dark mt-5">
    <div class="container"><p class="m-0 text-center text-white">Ontworpen door Benjamin Migom - 2024</p></div>
</footer>

@livewireScripts
</body>

</html>

