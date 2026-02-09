{{-- <!DOCTYPE html>
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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}




<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Marketplace')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-100">

<!-- NAVBAR -->
<nav x-data="{ open: false }"
     class="bg-white shadow-md fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4">

        <div class="flex justify-between items-center">
            <!-- LOGO -->
            <a href="{{ route('home') }}"
               class="text-xl sm:text-2xl font-bold text-indigo-600">
                MarketPlace
            </a>

            <!-- HAMBURGER (MOBILE) -->
            <button @click="open = !open"
                    class="sm:hidden text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-7 w-7"
                     fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- DESKTOP MENU -->
            <div class="hidden sm:flex items-center gap-4">
                <a href="{{ route('products.index') }}"
                   class="px-5 py-2 rounded-full bg-gray-100 text-gray-700 text-sm
                          hover:bg-indigo-100 hover:text-indigo-600 transition">
                    All Products
                </a>

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="px-5 py-2 rounded-full bg-red-600 text-white text-sm
                                    hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>

                @else
                    <a href="{{ route('login') }}"
                       class="px-5 py-2 rounded-full bg-blue-600 text-white text-sm
                              hover:bg-blue-700 transition">
                        Login
                    </a>
                @endauth
            </div>
        </div>

        <!-- MOBILE MENU -->
        <div x-show="open"
             x-transition
             @click.outside="open = false"
             class="sm:hidden mt-4 space-y-2">

            <a href="{{ route('products.index') }}"
               class="block w-full px-4 py-2 rounded-lg
                      bg-gray-100 text-gray-700 text-sm
                      hover:bg-indigo-100 hover:text-indigo-600 transition">
                All Products
            </a>

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="block w-full px-4 py-3
                                rounded-lg
                                bg-red-600 text-white
                                text-sm font-medium
                                hover:bg-red-700
                                transition">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="block w-full px-4 py-2 rounded-lg
                          bg-blue-600 text-white text-sm
                          hover:bg-blue-700 transition">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>


<!-- CONTENT -->
<main class="pt-14">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="bg-gray-900 text-gray-300 py-8 mt-20">
    <div class="max-w-7xl mx-auto px-6 text-center text-sm">
        © {{ date('Y') }} Marketplace | Skripsi Laravel
    </div>
</footer>

</body>
</html>
