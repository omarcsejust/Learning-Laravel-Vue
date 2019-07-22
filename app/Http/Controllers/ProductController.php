<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function form(){
        $products = Product::paginate(5);
        return view('product/form',compact('products'));
    }

    public function addProduct(Request $request){
        //print_r($request->all());
        //echo $request->product_name;

        Product::validateModel($request);

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

    public function deleteProduct($id){
        Product::find($id)->delete();
        return back()->with('delete_status','Deleted Successfully');
    }

    public function updateProductForm($id){
        $product = Product::findOrFail($id);
        return view('product/update',compact('product'));
    }

    public function updateProduct(Request $request){
        $product = [
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_alert_quantity' => $request->product_alert_quantity,
        ];

        Product::find($request->id)->update($product);

        return back()->with('update_status','Product Updated Successfully.');
    }
}
