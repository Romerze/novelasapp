<nav class="bg-white border-b border-gray-200 fixed w-full top-0 z-50 shadow" data-flowbite-collapse-target="navbar">
    <div class="max-w-7xl mx-auto px-3 py-2">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 rtl:space-x-reverse shrink-0">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary-500">
                    <path d="M21 7V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V7C3 4 4.5 2 8 2H16C19.5 2 21 4 21 7Z" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M15.5 2V9.85999C15.5 10.3 14.98 10.52 14.66 10.23L12.34 8.09003C12.15 7.91003 11.85 7.91003 11.66 8.09003L9.34003 10.23C9.02003 10.52 8.5 10.3 8.5 9.85999V2" stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="self-center text-lg font-serif font-semibold whitespace-nowrap">
                    <span class="text-primary-500">Novelas</span><span class="text-gray-700">App</span>
                </span>
            </a>
            
            <!-- Menú principal para escritorio -->
            <div class="hidden md:flex items-center space-x-1 mx-4 flex-1">
                <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors duration-150">
                    <i class="fas fa-tachometer-alt mr-1.5 text-xs"></i>Dashboard
                </a>
                <a href="{{ route('novelas.index') }}" class="px-3 py-1.5 rounded-md text-sm font-medium {{ request()->routeIs('novelas.*') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors duration-150">
                    <i class="fas fa-book mr-1.5 text-xs"></i>Novelas
                </a>
                <a href="{{ route('generos.index') }}" class="px-3 py-1.5 rounded-md text-sm font-medium {{ request()->routeIs('generos.*') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors duration-150">
                    <i class="fas fa-tags mr-1.5 text-xs"></i>Géneros
                </a>
                <a href="{{ route('inicio') }}" class="px-3 py-1.5 rounded-md text-sm font-medium {{ request()->routeIs('inicio') ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-gray-50' }} transition-colors duration-150">
                    <i class="fas fa-globe mr-1.5 text-xs"></i>Sitio Público
                </a>
            </div>
            
            <!-- Acciones rápidas -->
            <div class="flex items-center space-x-2">
                <!-- Búsqueda -->
                <button type="button" data-dropdown-toggle="search-dropdown" class="p-1.5 text-gray-500 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-primary-300">
                    <span class="sr-only">Buscar</span>
                    <i class="fas fa-search text-sm"></i>
                </button>
                
                <!-- Dropdown de usuario -->
                <button type="button" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-end" class="flex text-sm bg-primary-100 rounded-full focus:outline-none focus:ring-1 focus:ring-primary-300 ml-1">
                    <span class="sr-only">Abrir menú de usuario</span>
                    <div class="relative inline-flex items-center justify-center w-8 h-8 overflow-hidden rounded-full bg-primary-500 text-white">
                        <span class="font-medium text-xs">{{ Auth::check() ? substr(Auth::user()->name, 0, 1) : 'G' }}</span>
                    </div>
                </button>
                
                <!-- Botón de menú móvil -->
                <button data-collapse-toggle="navbar-mobile" type="button" class="inline-flex items-center p-1.5 text-sm text-gray-500 rounded-md md:hidden hover:bg-gray-100 focus:outline-none focus:ring-1 focus:ring-primary-300">
                    <span class="sr-only">Abrir menú principal</span>
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Dropdown de búsqueda -->
    <div class="z-50 hidden my-2 w-full md:w-80 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg" id="search-dropdown">
        <div class="px-4 py-3">
            <form action="{{ route('buscar') }}" method="GET">
                <label for="search-input" class="mb-2 text-sm font-medium text-gray-900 sr-only">Buscar</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="search" id="search-input" name="q" class="block w-full p-2.5 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-primary-500 focus:border-primary-500" placeholder="Buscar novelas, capítulos...">
                    <button type="submit" class="absolute inset-y-0 end-0 flex items-center pe-3 text-primary-500 hover:text-primary-600">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Dropdown menu de usuario -->
    <div class="z-50 hidden my-2 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg" id="user-dropdown">
        <div class="px-4 py-3">
            @if(Auth::check())
            <span class="block text-sm text-gray-900 font-medium">{{ Auth::user()->name }}</span>
            <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
            @else
            <span class="block text-sm text-gray-900 font-medium">Guest</span>
            <span class="block text-sm text-gray-500 truncate">Not logged in</span>
            @endif
        </div>
        <ul class="py-2" aria-labelledby="user-menu-button">
            @if(Auth::check())
            <li>
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-user-circle mr-2 text-primary-500"></i>Mi perfil
                </a>
            </li>
            <li>
                <a href="{{ route('capitulos.mis-guardados') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-bookmark mr-2 text-primary-500"></i>Mis capítulos guardados
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt mr-2 text-primary-500"></i>Cerrar sesión
                    </a>
                </form>
            </li>
            @endif
        </ul>
    </div>
    
    <!-- Menú móvil -->
    <div class="items-center justify-between hidden w-full md:hidden bg-white border-t border-gray-200" id="navbar-mobile">
        <ul class="flex flex-col py-2 px-4 font-medium">
            <li>
                <a href="{{ route('dashboard') }}" class="block py-2 px-3 mb-1 rounded {{ request()->routeIs('dashboard') ? 'text-white bg-primary-500' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('novelas.index') }}" class="block py-2 px-3 mb-1 rounded {{ request()->routeIs('novelas.*') ? 'text-white bg-primary-500' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-book mr-2"></i>Mis Novelas
                </a>
            </li>
            <li>
                <a href="{{ route('generos.index') }}" class="block py-2 px-3 mb-1 rounded {{ request()->routeIs('generos.*') ? 'text-white bg-primary-500' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-tags mr-2"></i>Géneros
                </a>
            </li>
            <li>
                <a href="{{ route('inicio') }}" class="block py-2 px-3 mb-1 rounded {{ request()->routeIs('inicio') ? 'text-white bg-primary-500' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-globe mr-2"></i>Sitio Público
                </a>
            </li>
        </ul>
    </div>
</nav>
