<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Dashboard for CRUD operations on all product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dashboard(){
        //get all active products
        $products = Product::paginate(5);

        //get all soft deleted products
        $deleted_products = Product::onlyTrashed()
            ->get();

        return view('product/product_dashboard',compact('products','deleted_products'));
    }

    /**
     * add product and return to the same blade
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * this action will redirect user to a new blade called update blade
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function updateProductForm($id){
        $product = Product::findOrFail($id);
        return view('product/update',compact('product'));
    }

    /**
     * Update an entity
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProduct(Request $request){
        $product = [
            'product_name' => $request->product_name,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_alert_quantity' => $request->product_alert_quantity,
        ];

        Product::findOrFail($request->id)
            ->update($product);

        return back()->with('update_status','Product Updated Successfully.');
    }

    /**
     * action for Delete a product (soft delete)
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($id){
        Product::findOrFail($id)
            ->delete();

        return back()->with('delete_status','Deleted Successfully');
    }

    /**
     * restore the deleted product
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreProduct($id){
        Product::withTrashed()
            ->where('id',$id)
            ->restore();

        return back()->with('restore_status','Product Restored Successfully');
    }

    /**
     * permanently delete a product from deleted list (REMEMBER WE ARE DELETING FROM DELETED LIST, NOT FROM ACTIVE LIST)
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteProduct($id){
        Product::withTrashed()
            ->where('id',$id)
            ->forceDelete();
        return back()->with('restore_status','Product Permanently Deleted');
    }
}
