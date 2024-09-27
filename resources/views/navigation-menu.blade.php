<nav x-data="{ open: false }" style="background-color: rgb(8, 57, 8)" class="text-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-authentication-card-logo/>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Settings Dropdown -->
                    <div class="ms-3 relative">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button class="flex text-sm border-2 border-transparent rounded-full focus: transition">
                                    Anuncios
                                </button>
                            </x-slot>
                            <x-slot name="content">
                                <div class="w-60">
                                    <x-dropdown-link href="/">
                                        Anuncios
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{#">
                                        Mesas de Examen
                                    </x-dropdown-link>
                                </div>
                                @can('admin.anuncio.create')
                                    <x-dropdown-link href="{{route('admin.anuncio.index')}}">
                                        Lista de Anuncios
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{route('admin.anuncio.create')}}">
                                        Nuevo Anuncio
                                    </x-dropdown-link>
                                @endcan    
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                    
                <!-- Navigation Links -->
                @can('prece.curso.index')
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('prece.curso.index') }}" :active="request()->routeIs('prece.curso.index')">
                            Mis Cursos
                        </x-nav-link>
                    </div>
                @endcan
            </div>

            @can('admin.users.index')
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="flex text-sm border-2 border-transparent rounded-full focus: transition">
                                Registro de Usuarios
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="w-60">
                                <x-dropdown-link href="{{route('admin.users.index')}}">
                                    Registro
                                </x-dropdown-link>
                                <x-dropdown-link href="{{route('admin.users.create')}}">
                                    Nuevo Usuario
                                </x-dropdown-link>
                            </div>   
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            @endcan

            @php
                $hasPermission = Auth::user()->can('admin.configuracion.index') ||
                Auth::user()->can('admin.roles.index') ||
                Auth::user()->can('admin.cursos.create') ||
                Auth::user()->can('cooperadora.pagos.index') ||
                Auth::user()->can('admin.materias.index');
            @endphp

            @if($hasPermission)
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex text-sm border-2 border-transparent rounded-full focus: transition">
                                Configuracion
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            @can('admin.configuracion.index')
                            <div class="w-60">
                                <x-dropdown-link href="{{route('admin.configuracion.index')}}">
                                    Configuracion
                                </x-dropdown-link>
                                <x-dropdown-link href="#">
                                    Mesas de Examen
                                </x-dropdown-link>
                            </div>
                            @endcan
                            @can('admin.cursos.index')
                            <div class="w-60">
                                <p class="block px-4 py-2 text-xs text-gray-400">Cursos</p>
                                <x-dropdown-link href="{{route('admin.cursos.index')}}">
                                    Lista de Cursos
                                </x-dropdown-link>
                                <x-dropdown-link href="{{route('admin.cursos.create')}}">
                                    Nuevo Curso
                                </x-dropdown-link>
                            </div>
                            @endcan    
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            @endif

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- Settings Dropdown -->
                <div class="ms-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus: transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-white bg-white dark:bg-gray-800 hover:text-white dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Cuenta
                            </div>

                            <x-dropdown-link href="{{ route('dashboard') }}">
                                Perfil
                            </x-dropdown-link>

                            <x-dropdown-link href="{{ route('profile.show') }}">
                                Ajustes
                            </x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    Cerrar Sesion
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white dark:text-gray-500 hover:text-gray-500 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="flex items-center px-4 my-2">
            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 me-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
            @endif

            <div>
                <div class="font-medium text-base text-white dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
        </div>
        
        <!-- Responsive Settings Options -->
        <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="/">
                    Anuncios
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{#">
                    Mesas de Examen
                </x-responsive-nav-link>
                @can('admin.anuncio.create')
                <x-responsive-nav-link href="{{ route('admin.anuncio.index') }}" :active="request()->routeIs('admin.anuncio.index')">
                    Lista de Anuncios
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.anuncio.create') }}" :active="request()->routeIs('admin.anuncio.create')">
                    Nuevo Anuncio
                </x-responsive-nav-link>
                @endcan
            </div>
        </div>
        
        @can('prece.curso.index')
        <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('prece.curso.index') }}" :active="request()->routeIs('prece.curso.index')">
                    Mis Cursos
                </x-responsive-nav-link>
            </div>
        </div>
        @endcan

        @can('admin.users.index')
        <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="pt-2 pb-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.index')">
                    Registro de Usuarios
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.users.create') }}" :active="request()->routeIs('admin.users.create')">
                    Nuevo Usuario
                </x-responsive-nav-link>
            </div>
        </div>
        @endcan
        
        @php
            $hasPermission = Auth::user()->can('admin.configuracion.index') ||
            Auth::user()->can('admin.roles.index') ||
            Auth::user()->can('admin.cursos.create') ||
            Auth::user()->can('cooperadora.pagos.index') ||
            Auth::user()->can('admin.materias.index');
        @endphp
        
        @if ($hasPermission)
        <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="pt-2 pb-3 space-y-1">
                @can('admin.configuracion.index')
                <x-responsive-nav-link href="{{route('admin.configuracion.index')}}">
                    Configuracion
                </x-responsive-nav-link>
                @endcan
                <x-responsive-nav-link href="{#">
                    Mesas de Examen
                </x-responsive-nav-link>
                @can('admin.cursos.index')
                <x-responsive-nav-link href="{{ route('admin.cursos.index') }}" :active="request()->routeIs('admin.curso.index')">
                    Lista de Cursos
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('admin.cursos.create') }}" :active="request()->routeIs('admin.curso.create')">
                    Nuevo Curso
                </x-responsive-nav-link>
                @endcan
            </div>
        </div>
        @endif

        <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="pt-2 pb-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    Perfil
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    Ajustes
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}"
                                   @click.prevent="$root.submit();">
                        Cerra Sesion
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>