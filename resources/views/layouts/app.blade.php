<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? 'Campus Virtual' }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <style>
            nav{background-color: rgb(7, 63, 7)}
        </style>
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        
        @auth
            @livewire('navigation-menu')
        @else
            <nav x-data="{ open: false }" class="border-b border-gray-100">
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
                                    <div class="w-60">
                                        <x-dropdown-link href="#">
                                            Anuncios
                                        </x-dropdown-link>
                                        <x-dropdown-link href="{#">
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
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="min-h-screen bg-gray-100">
            {{ $slot }}
        </main>

        @stack('modals')

        @livewireScripts
        <footer class="py-16 text-center text-sm text-black">
            mml
        </footer>
    </body>
</html>
