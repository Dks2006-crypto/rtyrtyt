<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        $products = [];
        $total = 0;

        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)->get();

            foreach ($products as $product) {
                $product->quantity = $cart[$product->id]['quantity'];
                $total += $product->price * $product->quantity;
            }
        }

        return view('cart', compact('products', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'quantity' => $quantity,
                'price' => $product->price,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function remove(Product $product)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Товар удален из корзины');
    }

    public function update(Product $product, Request $request)
    {
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);

        if ($quantity <= 0) {
            return $this->remove($product);
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $quantity;
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Количество обновлено');
    }

    public function clear()
    {
        Session::forget('cart');
        return redirect()->route('cart.index')->with('success', 'Корзина очищена');
    }
}
