<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Кнопка "Назад" -->
    <a href="{{ url()->previous() }}" class="inline-flex items-center text-[#E31834] hover:text-[#C01024] mb-6 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Вернуться назад
    </a>

    <!-- Общий контейнер -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Grid для адаптивности: в одну колонку на маленьких экранах, в две на средних и больших -->
        <div class="md:flex">
            <!-- Блок с изображением -->
            <div class="md:w-1/2 p-6">
                @if($product->is_sale)
                    <div class="bg-[#E31834] text-white text-sm font-bold px-3 py-1 absolute ml-6 mt-6 rounded-lg z-10">
                        Акция
                    </div>
                @endif

                <div class="bg-gray-50 rounded-lg h-96 flex items-center justify-center p-8 relative overflow-hidden">
                    @if($product->image)
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            class="max-h-full max-w-full object-contain transition-transform duration-300 hover:scale-105"
                        >
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    @endif
                </div>
            </div>

            <!-- Блок с информацией -->
            <div class="md:w-1/2 p-6 flex flex-col">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name }}</h1>

                <!-- Категория -->
                <div class="mb-4">
                    <span class="text-sm text-gray-500">Категория:</span>
                    <a href="{{ route('category', $product->category->slug) }}" class="text-[#E31834] hover:underline ml-2">
                        {{ $product->category->name }}
                    </a>
                </div>

                <!-- Цена -->
                <div class="mb-6">
                    @if($product->is_sale && $product->old_price)
                        <div class="flex items-baseline">
                            <span class="text-4xl font-bold text-[#E31834]">{{ number_format($product->price, 2) }} ₽</span>
                            <span class="text-xl line-through text-gray-400 ml-3">{{ number_format($product->old_price, 2) }} ₽</span>
                        </div>
                        <span class="inline-block bg-[#E31834] bg-opacity-10 text-[#E31834] text-sm font-semibold px-3 py-1 rounded-full mt-2">
                            Экономия {{ number_format($product->old_price - $product->price, 2) }} ₽
                        </span>
                    @else
                        <span class="text-4xl font-bold text-gray-900">{{ number_format($product->price, 2) }} ₽</span>
                    @endif
                </div>

                <!-- Описание -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Описание</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $product->description }}</p>
                </div>

                <!-- Кнопка добавления в корзину -->
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-auto">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                            <button type="button" class="quantity-btn px-3 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200" data-action="decrement">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <input
                                type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                class="w-16 px-2 py-2 text-center border-0 focus:ring-2 focus:ring-[#E31834]"
                                id="quantity-input"
                            >
                            <button type="button" class="quantity-btn px-3 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200" data-action="increment">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                            </button>
                        </div>

                        <button
                            type="submit"
                            class="flex-1 bg-[#E31834] hover:bg-[#C01024] text-white px-6 py-3 rounded-lg font-medium transition-colors flex items-center justify-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Добавить в корзину
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Обработчик изменения количества
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = document.getElementById('quantity-input');
            let value = parseInt(input.value);

            if (this.dataset.action === 'increment') {
                input.value = value + 1;
            } else {
                if (value > 1) {
                    input.value = value - 1;
                }
            }
        });
    });
</script>

<style>
    /* Скрытие стрелок у input number */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
