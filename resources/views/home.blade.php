@extends('layouts.app')

@section('title', 'Главная')


@section('content')

@include('components.welcome')

@include('components.info')

    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6">Категории</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach($categories as $category)
                <a
                    href="{{ route('category', $category->slug) }}"
                    class="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow text-center"
                >
                    <div class="text-blue-600 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="font-semibold">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $category->products_count }} товаров</p>
                </a>
            @endforeach
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-6">Новые поступления</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>

    @if($saleProducts->count() > 0)
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Акции</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($saleProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    @endif
@endsection


