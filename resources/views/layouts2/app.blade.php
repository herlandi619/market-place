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
            <a href="{{ route('admin.dashboard') }}"
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
              

                @auth
                    <div x-data="{ open: false }" class="relative">

                    <!-- Trigger Button -->
                    <button 
                        @click="open = !open"
                        class="relative inline-flex items-center gap-2
                            px-4 py-2 rounded-full
                            bg-gray-100 text-gray-700 text-sm
                            hover:bg-indigo-100 hover:text-indigo-600
                            transition">

                        📚 Menu

                        <!-- Cart Badge -->
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1
                                        bg-red-600 text-white
                                        text-xs font-bold
                                        min-w-[18px] h-[18px]
                                        flex items-center justify-center
                                        px-1
                                        rounded-full">
                                {{ $cartCount }}
                            </span>
                        @endif

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown -->
                    <div 
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48
                            bg-white rounded-xl shadow-lg
                            overflow-hidden z-50">

                        <a href="{{ route('admin.users.index') }}"
                        class="flex items-center justify-between
                                px-4 py-3 text-sm
                                hover:bg-gray-100 transition">
                            🙎‍♂️ Manajemen Akun
                        </a>

                        <a href="{{ route('orders.index') }}"
                        class="flex items-center
                                px-4 py-3 text-sm
                                hover:bg-gray-100 transition">
                            📌 My Orders
                        </a>
                    </div>

                </div>



                    <div x-data="{ open: false }" class="relative">
                        <!-- Trigger -->
                        <button
                            @click="open = !open"
                            class="flex items-center gap-2 px-4 py-2 rounded-full
                                bg-gray-100 hover:bg-gray-200 transition text-sm"
                        >
                            Hello, {{ Auth::user()->name }} 😉
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div
                            x-show="open"
                            @click.outside="open = false"
                            x-transition
                            class="absolute right-0 mt-2 w-44 bg-white rounded-xl shadow-lg overflow-hidden z-50"
                        >
                            <!-- Profile -->
                            <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-3 text-sm hover:bg-gray-100">
                                Profile
                            </a>

                            <!-- Divider -->
                            <div class="border-t"></div>

                            <!-- Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-3 text-sm text-red-600
                                            hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>


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
            x-cloak
            @click.outside="open = false"
            class="sm:hidden mt-4 space-y-3">


            @auth
                <!-- Cart -->
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3
                            w-full px-4 py-3
                            rounded-xl
                            bg-gray-100 text-gray-700 text-sm font-medium
                            hover:bg-indigo-100 hover:text-indigo-600
                            transition">

                        <!-- ICON + BADGE -->
                        <span class="relative inline-flex items-center justify-center">
                            🙎‍♂️
                            
                        </span>

                        <!-- TEXT -->
                        <span>Manajemen Akun</span>
                    </a>


                    <a href="{{ route('orders.index') }}"
                    class="flex items-center gap-3
                            w-full px-4 py-3
                            rounded-xl
                            bg-gray-100 text-gray-700 text-sm font-medium
                            hover:bg-indigo-100 hover:text-indigo-600
                            transition">

                        <!-- ICON + BADGE -->
                        <span class="relative inline-flex items-center justify-center">
                            📌
                            
                        </span>

                        <!-- TEXT -->
                        <span>My Orders</span>
                    </a>



                    <!-- Trigger -->
                    <button
                        @click="open = !open"
                        class="flex items-center justify-between
                            w-full px-4 py-3
                            rounded-xl
                            bg-gray-100 text-gray-700
                            text-sm font-medium
                            hover:bg-gray-200 transition"
                    >
                        <span>Hello, {{ Auth::user()->name }}</span>

                        <svg class="w-4 h-4 transition"
                            :class="{ 'rotate-180': open }"
                            fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <!-- Dropdown Mobile -->
                    <div x-show="open"
                        x-transition
                        x-cloak
                        class="mt-2 space-y-2">

                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}"
                        @click="open = false"
                        class="block w-full px-4 py-3
                                rounded-xl
                                bg-gray-100 text-sm
                                hover:bg-indigo-100 hover:text-indigo-600
                                transition">
                            👤 Profile
                        </a>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}"
                            @submit="open = false">
                            @csrf
                            <button type="submit"
                                    class="block w-full px-4 py-3
                                        rounded-xl
                                        bg-red-600 text-white
                                        text-sm font-semibold
                                        hover:bg-red-700 transition">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
            @else
                <!-- Login -->
                <a href="{{ route('login') }}"
                class="flex items-center gap-3
                        w-full px-4 py-3
                        rounded-xl
                        bg-blue-600 text-white
                        text-sm font-semibold
                        hover:bg-blue-700
                        transition">
                    🔐 <span>Login</span>
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
