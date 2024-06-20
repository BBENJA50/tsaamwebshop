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

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet"/>
    <link rel="icon" href="{{ asset('Accenten.svg') }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div class="mb-4">
        <a href="/" wire:navigate>
            <x-application-logo class="w-[200px] sm:w-[300px] h-[60px] sm:h-[100px] fill-current text-gray-500"/>
        </a>
    </div>

    <!-- Login -->
    <div class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 flex flex-col text-center justify-center my-4 bg-white text-xl p-8 rounded text-black dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        @livewire('pages.auth.login')
    </div>

    <!-- Registreer -->
    <div class="w-full sm:w-3/4 md:w-1/2 lg:w-1/3 xl:w-1/4 flex flex-col text-center items-center content-center justify-end my-4 bg-white text-xl p-8 rounded text-black dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <p class="text-sm underline mb-2 text-gray-600 dark:text-gray-400">Nog geen account?</p>
        <a href="{{ route('register') }}"
           class="text-sm bg-tsaam-500 border-2 border-gray-200 px-8 py-2 font-bold no-underline hover:no-underline hover:text-tsaam-400 rounded-xl hover:bg-tsaam-600 dark:hover:bg-tsaam-700 dark:bg-tsaam-800 dark:text-tsaam-500 dark:hover:text-white uppercase">
            Registreer
        </a>
    </div>
</div>
</body>
</html>
