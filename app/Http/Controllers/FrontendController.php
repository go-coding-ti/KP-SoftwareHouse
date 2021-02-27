<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontendController extends Controller
{
    public function product(){
        $products = Product::all();
        return view('frontend.product',compact('products'));
    }
}
