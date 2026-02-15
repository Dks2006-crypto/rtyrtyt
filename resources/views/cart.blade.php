@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Корзина</h1>

        @if(count($products) > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="divide-y divide-gray-200">
                    @foreach($products as $product)
                        <div class="p-6 flex flex-col md:flex-row items-center">
                            <div class="w-full md:w-1/4 mb-4 md:mb-0">
                                @if($product->image)
                                    <img
                                        src="{{ asset('storage/' . $product->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-24 h-24 object-contain mx-auto"
                                    >
                                @else
                                    <div class="w-24 h-24 bg-gray-100 flex items-center justify-center mx-auto">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="w-full md:w-2/4 px-4">
                                <h3 class="font-semibold text-lg">{{ $product->name }}</h3>
                                <p class="text-gray-600">{{ number_format($product->price, 2) }} ₽</p>
                            </div>

                            <div class="w-full md:w-1/4 flex items-center justify-between mt-4 md:mt-0">
                                <form action="{{ route('cart.update', $product) }}" method="POST" class="flex items-center">
                                    @csrf
                                    <input
                                        type="number"
                                        name="quantity"
                                        value="{{ $product->quantity }}"
                                        min="1"
                                        class="w-16 px-2 py-1 border border-gray-300 rounded-md text-center"
                                        onchange="this.form.submit()"
                                    >
                                </form>

                                <span class="font-semibold ml-4">
                                    {{ number_format($product->price * $product->quantity, 2) }} ₽
                                </span>

                                <form action="{{ route('cart.remove', $product) }}" method="POST" class="ml-4">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-6 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <div class="text-xl font-semibold">
                            Итого: {{ number_format($total, 2) }} ₽
                        </div>

                        <div class="space-x-4">
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 border border-red-500 text-red-500 rounded-md hover:bg-red-50">
                                    Очистить корзину
                                </button>
                            </form>

                            <a
                                href="#"
                                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700"
                            >
                                Оформить заказ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Ваша корзина пуста</h3>
                <p class="text-gray-500 mb-4">Добавьте товары, чтобы продолжить</p>
                <a
                    href="{{ route('home') }}"
                    class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 inline-block"
                >
                    Вернуться к покупкам
                </a>
            </div>
        @endif
    </div>
@endsection
