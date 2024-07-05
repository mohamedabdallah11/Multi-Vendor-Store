<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // that's for viewning product details

    public function index(){

    }
    public function show(Product $Product ){
        if($Product->status != 'active'){
            abort(404);
        }   
        return view('front.products.show',compact('Product'));
    }
}
