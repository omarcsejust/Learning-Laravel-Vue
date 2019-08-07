<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;

class FrontendController extends Controller
{
    public function index(){
        $products = Product::all();
        $categories = Category::all();
        return view('welcome',compact('products','categories'));
    }

    public function productDetails($id){
        $product = Product::findOrFail($id);
        $related_products = Product::where('id','!=',$id)->get();
        return view('frontend/product_details',compact('product','related_products'));
    }
}
