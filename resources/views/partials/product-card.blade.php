<div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group relative border border-gray-100">
    <!-- Бейдж акции -->
    @if($product->is_sale)
        <div class="bg-[#E31834] text-white text-xs font-bold px-3 py-1 absolute top-3 left-3 rounded-full z-10 shadow-sm animate-pulse">
            Акция
        </div>
    @endif

    <!-- Изображение товара -->
    <a href="{{ route('product.show', $product->slug) }}" class="block relative">
        <div class="bg-gray-50 h-52 flex items-center justify-center p-4 relative overflow-hidden">
            @if($product->image)
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="h-full w-full object-contain transition-transform duration-300 group-hover:scale-105"
                    loading="lazy"
                >
            @else
                <div class="text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                </div>
            @endif
        </div>
    </a>

    <!-- Контент карточки -->
    <div class="p-5">
        <!-- Название -->
        <a href="{{ route('product.show', $product->slug) }}" class="block mb-2">
            <h3 class="font-semibold text-gray-800 hover:text-[#E31834] transition-colors line-clamp-2">
                {{ $product->name }}
            </h3>
        </a>

        <!-- Производитель (если есть) -->
        @if($product->manufacturer)
            <div class="text-xs text-gray-500 mb-3">
                {{ $product->manufacturer }}
            </div>
        @endif

        <!-- Цена и кнопка -->
        <div class="flex items-center justify-between mt-4">
            <div>
                @if($product->is_sale && $product->old_price)
                    <div class="text-[#E31834] font-bold text-lg">{{ number_format($product->price, 2) }} ₽</div>
                    <div class="text-xs line-through text-gray-500">{{ number_format($product->old_price, 2) }} ₽</div>
                @else
                    <div class="font-bold text-gray-800 text-lg">{{ number_format($product->price, 2) }} ₽</div>
                @endif
            </div>

            <!-- Кнопка корзины -->
            <form action="{{ route('cart.add', $product) }}" method="POST">
                @csrf
                <input type="hidden" name="quantity" value="1">
                <button
                    type="submit"
                    class="bg-[#E31834] hover:bg-[#C01024] text-white rounded-lg px-3 py-2 flex items-center transition-all cursor-pointer duration-200 hover:shadow-md active:bg-[#A00C1C]"
                    title="Добавить в корзину"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </button>
            </form>
        </div>

    </div>
</div>
