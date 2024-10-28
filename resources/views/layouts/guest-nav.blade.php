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
                    <x-authentication-card-logo/>
                </a>
            </div>
            
            @if (Route::has('login'))
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <a class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md text-white hover:text-white focus:outline-none focus: transition ease-in-out duration-150" href="{{ route('login') }}">Ingresa</a>
            </div>
            @endif
        
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out"     aria-label="Toggle navigation">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="flex items-center  my-2">
            <div>
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2">
                    <img class="h-10 w-10 rounded-full object-cover" src="https://www.tecnica3mdp.edu.ar/imagenes/loguito.png"/>
                </a>
            </div>
        </div>
        <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="/">
                    Anuncios
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{route('admin.mesas.index')}}">
                    Mesas de Examen
                </x-responsive-nav-link>
            </div>
        </div>
        <div class="pt-2 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                    Ingresar
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>