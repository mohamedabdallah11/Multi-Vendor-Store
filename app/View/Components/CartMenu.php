<?php

namespace App\View\Components;

use App\Facades\Cart;
use App\Repositories\Cart\CartRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $items;
    public $total;
    public function __construct( CartRepository $cart)
    {
       /*  $this->items=Cart::get();
        $this->total=Cart::Total(); */
        $this->items=$cart->get();
        $this->total=$cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-menu');
    }
}
