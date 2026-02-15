@extends('layouts.app')

@section('title', $category->name)

@section('content')
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="w-full md:w-1/4 lg:w-1/5">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="font-bold text-lg mb-4">Категории</h3>
                <ul class="space-y-2">
                    @foreach($categories as $cat)
                        <li>
                            <a
                                href="{{ route('category', $cat->slug) }}"
                                class="block px-3 py-2 rounded {{ $category->id == $cat->id ? 'bg-blue-100 text-blue-600' : 'hover:bg-gray-100' }}"
                            >
                                {{ $cat->name }}
                                <span class="text-xs text-gray-500 ml-1">({{ $cat->products_count }})</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="w-full md:w-3/4 lg:w-4/5">
            <h1 class="text-2xl font-bold mb-6">{{ $category->name }}</h1>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white p-8 rounded-lg shadow text-center">
                    <p class="text-gray-500">В этой категории пока нет товаров</p>
                </div>
            @endif
        </div>
    </div>
@endsection
