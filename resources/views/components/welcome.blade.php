<!-- resources/views/components/pharmacy-banner.blade.php -->
<section class="bg-white py-8 md:py-12 rounded-[20px] shadow-xl">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between">
            <!-- Текстовая часть -->
            <div class="w-full md:w-[45%]">
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-3">
                    Добро пожаловать в аптеку <span class="text-[#E31834]">"5 Звёзд"</span>
                </h1>

                <p class="text-gray-700 text-lg mb-6 italic">
                    – ваш надежный партнер в заботе о здоровье!
                </p>

                <div class="mb-8">
                    <p class="text-gray-900 font-medium">
                        <span class="text-[#E31834] font-bold">5 Звёзд:</span> Здоровье с заботой, качество с гарантией.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/catalog" class="bg-[#E31834] hover:bg-[#C2162E] text-white px-6 py-3 rounded-lg text-center font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                        Каталог товаров
                    </a>
                    <a href="/promotions" class="bg-white text-[#E31834] border-2 border-[#E31834] hover:bg-[#E31834] hover:text-white px-6 py-3 rounded-lg text-center font-medium transition-all duration-300 transform hover:scale-105">
                        Наши Акции
                    </a>
                </div>
            </div>

            <!-- Изображение -->
            <div class="hidden md:flex md:w-[50%] justify-end items-start">
                <img src="{{ asset('img/wel.svg') }}" alt="Аптека 5 Звёзд" class="rounded-[20px] w-[350px] h-auto">
            </div>
        </div>
    </div>
</section>
