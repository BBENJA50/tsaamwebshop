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
    <div>
        <a href="/" wire:navigate>
            <x-application-logo class="w-[300px] h-[100px] fill-current text-gray-500"/>
        </a>
    </div>
    <div class="flex flex-col text-center justify-center my-8 bg-white text-xl p-8 rounded text-black border-4">
        <p>Hallo, wij zijn 't Saam. Welkom in onze webshop.</p>
        <p>Gelieve in te loggen of een account aan te maken om verder te gaan. </p>
    </div>
{{--    Login--}}
    <div class="mt-10  ">
        <a href="{{ route('login') }}"
           class="text-4xl bg-tsaam-500 border-2 border-tsaam-700 px-8 py-2 font-bold no-underline hover:no-underline hover:text-tsaam-400 rounded-t-3xl hover:bg-tsaam-600 dark:hover:bg-tsaam-700 dark:bg-tsaam-800 dark:text-tsaam-500 dark:hover text-white">Login</a>
    </div>

{{--    Registreer--}}
    <div class="mt-12 ">
        <a href="{{ route('register') }}"
           class="text-4xl bg-tsaam-500 border-2 border-tsaam-700 px-8 py-2 font-bold no-underline hover:no-underline hover:text-tsaam-400 rounded-b-3xl hover:bg-tsaam-600 dark:hover:bg-tsaam-700 dark:bg-tsaam-800 dark:text-tsaam-500 dark:hover text-white">Registreer</a>
    </div>

</div>
</body>
</html>
