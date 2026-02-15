@extends('layouts.app')

@section('title', 'Результаты поиска')

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-bold mb-2">Результаты поиска: "{{ $search }}"</h1>
        <p class="text-gray-600">Найдено {{ $products->total() }} товаров</p>
    </div>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->appends(['q' => $search])->links() }}
        </div>
    @else
        <div class="bg-white p-8 rounded-lg shadow text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-xl font-semibold mb-2">Ничего не найдено</h3>
            <p class="text-gray-500 mb-4">Попробуйте изменить поисковый запрос</p>
            <a
                href="{{ route('home') }}"
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 inline-block"
            >
                Вернуться на главную
            </a>
        </div>
    @endif
@endsection
