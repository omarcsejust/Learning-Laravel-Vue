<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function form(){
        $products = Product::paginate(3);
        return view('product/form',compact('products'));
    }

    public function addProduct(Request $request){
        //print_r($request->all());
        //echo $request->product_name;

        $product = [
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_alert_quantity' => $request->product_alert_quantity,
        ];

        Product::insert($product);
        return back()->with('status', 'Product Added Successfully');

    }
}
