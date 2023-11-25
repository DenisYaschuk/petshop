<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Cart;

class CartComponent extends Component
{
    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $quantity = $product->qty + 1;
        Cart::update($rowId, $quantity);
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $quantity = $product->qty - 1;
        Cart::update($rowId, $quantity);
    }

    public function removeItem($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success_message', 'Item has been removed from Cart');
        $this->emitTo('cart-icon-component', 'refreshComponent');
    }

    public function removeAllItems()
    {
        Cart::destroy();
        session()->flash('success_message', 'All items has been removed from Cart');
    }

    public function render()
    {
        return view('livewire.cart-component');
    }
}
