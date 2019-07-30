<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontendController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('welcome',compact('products'));
    }

    public function productDetails($id){
        $product = Product::findOrFail($id);
        $related_products = Product::where('id','!=',$id)->get();
        return view('frontend/product_details',compact('product','related_products'));
    }
}
