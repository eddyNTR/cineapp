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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" style="background-image: url('{{ asset('storage/ciene-app.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center; background-attachment: fixed;">
        <div class="min-h-screen flex items-center justify-center px-4 py-10">
            <div class="w-full max-w-md mx-auto">
                <div class="bg-[rgba(20,6,29,0.6)] backdrop-blur-sm rounded-2xl shadow-2xl p-8 text-white">
                    <div class="flex flex-col items-center mb-6">
                        <img src="{{ asset('storage/palomitas-de-maiz.png') }}" alt="logo" class="w-12 h-12 mb-2">
                        <h1 class="text-2xl font-semibold">CineApp</h1>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
