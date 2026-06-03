<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ThriftIn') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8 selection:bg-primary-500 selection:text-white">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <a href="/" class="flex justify-center">
                <span class="text-4xl font-bold text-primary-600 tracking-tight">Thrift<span class="text-gray-900">In</span></span>
            </a>
            <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900">
                Welcome back!
            </h2>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl shadow-primary-500/5 sm:rounded-2xl sm:px-10 border border-gray-100">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
