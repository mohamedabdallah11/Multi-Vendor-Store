<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $cart;
    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    public function index( CartRepository $cart)    //1.09:10 safad 10.1
    {
         // $repository = new \App\Repositories\Cart\CartModelRepository();  we stored it in the service container in Cart provider in service provider and gonna call it by the service container App::make('cart')
   
        return view('front.cart', ['cart' => $cart]);
    }

     /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , CartRepository $cart)
    {
        $request->validate([
            'product_id' => ['required','int','exists:products,id'],
            'quantity' => ['nullable','int','min:1']
        ]);
        $product = Product::findOrFail($request->post('product_id')); 
        $cart->add($product, $request->post('quantity')); 
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully');

    }

    /**
     * Display the specified resource.
     */

    /**


    
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartRepository $cart)
    {
        
        $request->validate([
            'product_id' => ['required','int','exists:products,id'],
            'quantity' => ['nullable','int','min:1']
        ]);
        $product = Product::findOrFail($request->post('product_id')); 
       // $repository = new \App\Repositories\Cart\CartModelRepository();  we stored it in the service container in Cart provider in service provider and gonna call it by the service container App::make('cart')
       $cart->update($product, $request->post('quantity')); 

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart,string $id)
    {
        $cart->delete($id);
    } 
}
