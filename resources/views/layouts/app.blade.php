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
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
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
            .swiper-container { width: 50%; height: 50%;}
            .swiper-slide { display: flex; justify-content: center; align-items: center;}
        </style>
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        
        @auth
            @livewire('navigation-menu')
        @else
            <nav x-data="{ open: false }" style="background-color: rgb(7, 63, 7)" class="border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="left" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">           
                                        <button type="button" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white hover:text-white focus:outline-none focus: transition ease-in-out duration-150">
                                            Anuncios
                                        </button>
                                    </span>
                                </x-slot>
                                <x-slot name="content">
                                    <div>
                                        <x-dropdown-link href="/">
                                            Anuncios
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{{route('admin.mesas.index')}}">
                                            Mesas de Examen
                                        </x-dropdown-link>
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2">
                                <img class="h-10 w-10 rounded-full object-cover" src="https://www.tecnica3mdp.edu.ar/imagenes/loguito.png"/>
                            </a>
                        </div>
                        
                        @if (Route::has('login'))
                            <a class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white hover:text-white focus:outline-none focus: transition ease-in-out duration-150" href="{{ route('login') }}">Ingresa</a>
                        @endif
                    </div>
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </nav>
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
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    loop: false,
                });
            });
        </script>
        <footer style="background-color: rgb(7, 63, 7)" class="py-6 text-center text-sm text-white">
            &copy; 2024 mml
        </footer>
    </body>
</html>
