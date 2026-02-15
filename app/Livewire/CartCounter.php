<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CartCounter extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];

    public function render()
    {
        $cart = Session::get('cart', []);
        $count = array_reduce($cart, function($carry, $item) {
            return $carry + $item['quantity'];
        }, 0);

        return view('livewire.cart-counter', ['count' => $count]);
    }
}
