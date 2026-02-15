<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>


    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>


    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/heroicons@2.0.11/outline"></script>

    <style>
        [x-cloak] { display: none !important; }
        .aspect-square { aspect-ratio: 1/1; }
    </style>
</head>
<body class="bg-[#CEDCFF]">
    <!-- Header -->
    <header class="bg-white shadow-lg">
        <div class="container mx-auto px-6">
            <!-- Верхняя строка (Логотип + Навигация + Иконки) -->
            <div class="flex justify-between items-center py-4">
                <!-- Логотип -->
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('img/a5_logo.svg') }}" alt="Лого" class="w-10 sm:w-10 md:w-12">
                </a>

                <!-- Навигационное меню (скрыто на мобильных) -->
                <nav class="hidden md:flex space-x-8 mx-4">
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-[#E31834] font-semibold transition duration-300">Главная</a>
                    <a href="#" class="text-gray-800 hover:text-[#E31834] font-semibold transition duration-300">Категории</a>
                    <a href="#" class="text-gray-800 hover:text-[#E31834] font-semibold transition duration-300">Акции</a>
                </nav>

                <!-- Иконки -->
                <div class="flex items-center space-x-6">
                    <!-- Кнопка бургер-меню (только мобильная) -->
                    <button id="mobile-menu-button" class="text-gray-800 focus:outline-none md:hidden transition duration-300">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Корзина -->
                    <a href="{{ route('cart.index') }}" class="relative inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        @if($cartCount ?? 0 > 0)
                            <span class="absolute -top-2 -right-2 bg-[#E31834] text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Админка -->
                    @auth
                        <a href="{{ url('/admin') }}" class="text-gray-800 hover:text-[#E31834] flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="hidden lg:inline ml-1">Админка</span>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Строка поиска -->
            <div class="py-3 border-t border-gray-200">
                <form action="{{ route('product.search') }}" method="GET" class="max-w-3xl mx-auto">
                    <div class="relative flex">
                        <input
                            type="text"
                            name="q"
                            placeholder="Поиск лекарств"
                            class="w-full px-6 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#E31834] focus:border-transparent text-lg transition duration-300"
                            value="{{ request('q') }}"
                        >
                        <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-[#E31834] text-white p-2 rounded-lg hover:bg-[#C5162D] transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Мобильное меню (скрыто по умолчанию) -->
            <div id="mobile-menu" class="hidden md:hidden py-3 border-t border-gray-200">
                <div class="flex flex-col space-y-3 px-4">
                    <a href="{{ route('home') }}" class="text-gray-800 hover:text-[#E31834] font-semibold py-2 transition duration-300">Главная</a>
                    <a href="#" class="text-gray-800 hover:text-[#E31834] font-semibold py-2 transition duration-300">Категории</a>
                    <a href="#" class="text-gray-800 hover:text-[#E31834] font-semibold py-2 transition duration-300">Акции</a>
                </div>
            </div>
        </div>
    </header>



    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>
    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <h3 class="text-xl font-bold mb-4">Аптека</h3>
                    <p class="text-gray-400">Все лекарства в одном месте</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Контакты</h3>
                    <p class="text-gray-400">Телефон: +7 (123) 456-7890</p>
                    <p class="text-gray-400">Email: info@apteka.ru</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                &copy; {{ date('Y') }} Аптека. Все права защищены.
            </div>
        </div>
    </footer>

    @livewireScripts


    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
