<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        $saleProducts = Product::where('is_active', true)
            ->where('is_sale', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('home', compact('categories', 'products', 'saleProducts'));
    }

    public function category(Category $category)
    {
        $categories = Category::withCount('products')->get();
        $products = $category->products()->where('is_active', true)->paginate(12);

        return view('category', compact('category', 'categories', 'products'));
    }

    public function show(Product $product)
    {
        $categories = Category::withCount('products')->get();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('product', compact('product', 'categories', 'relatedProducts'));
    }

    public function search(Request $request)
    {
        $categories = Category::withCount('products')->get();
        $search = $request->input('q');

        $products = Product::where('is_active', true)
            ->where(function($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            })
            ->paginate(12)
            ->appends(['q' => $search]);

        return view('search', compact('categories', 'products', 'search'));
    }
}
