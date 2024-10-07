<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <style>
            .tarde { background-color: #fdfd96; }
            .ausente { background-color: #f8d7da; }
            .presente { background-color: #d4edda; }
            .tarde-darker { background-color: #f8f8ae; }
            .ausente-darker { background-color: #facbcb; }
            .presente-darker { background-color: #c1e0c4; }
            .switch { position: relative; display: inline-block; width: 80px; height: 40px; } /* Increased width and height */
            .switch input { opacity: 0; width: 0; height: 0; }
            .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; transition: .4s; border-radius: 40px; } /* Adjusted border-radius */
            .slider:before { position: absolute; content: ""; height: 32px; width: 32px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%; } /* Increased size */
            input:checked + .slider { background-color: #2196F3; }
            input:checked + .slider:before { transform: translateX(40px); } /* Adjusted translation for larger size */
            .labels { position: absolute; width: 100%; color: rgb(255, 255, 255); font-weight: bold; font-size: 14px; line-height: 40px; transition: .4s; } /* Increased font size */
            .aula-label {margin-rigth:2rem; text-align: right;}
            .taller-label { margin-left:2; text-align: left;}
            input:checked + .slider .aula-label { opacity: 0; }
            input:not(:checked) + .slider .taller-label { opacity: 0; }
        </style>
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        
        @auth
            @livewire('navigation-menu')
        @else
            @include('layouts.guest-nav')
        @endauth    

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 d-flex justify-content-between align-items-center mb-3">
                @yield('header')
            </div>
        </header>

        <!-- Page Content -->
        <main class="min-h-screen bg-gray-100">
            @yield('content')
        </main>

        @stack('modals')
        @livewireScripts

        <footer style="background-color: rgb(7, 63, 7)" class="py-6 text-center text-sm text-white">
            &copy; 2024 mml
        </footer>
    </body>
</html>
