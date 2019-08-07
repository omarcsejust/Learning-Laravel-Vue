<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;
use Image;

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

        //get all categories
        $categories = Category::all();

        return view('product/product_dashboard',compact('products','deleted_products', 'categories'));
    }

    /**
     * upload image with intervention image library
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
            'category_id' => $request->category_id,
            'product_description' => $request->product_description,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_alert_quantity' => $request->product_alert_quantity,
        ];

        //Product::insert($product); // insert the product to product table
        $last_inserted_product_id = Product::insertGetId($product); //return the inserted product id

        if ($request->hasFile('product_image')){ //if file submitted through this form with name product_image
            $image_to_upload = $request->product_image;
            $file_name = $last_inserted_product_id.'.'.$image_to_upload->getClientOriginalExtension();
            Image::make($image_to_upload)->resize(400,450)->save(base_path('public/uploads/product_images/'.$file_name));
            Product::findOrFail($last_inserted_product_id)->update([
                'product_image'=>$file_name
            ]);
        }
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

        if ($request->hasFile('product_image')){
            $current_img_file = Product::findOrFail($request->id)->product_image;

            $image_to_update = $request->product_image;
            $file_name = $request->id.'.'.$image_to_update->getClientOriginalExtension();

            if ($current_img_file == 'default_product_image.jpg'){
                //don't delete image, just upload new image to the upload product image directory
                Image::make($image_to_update)->resize(400,450)->save(base_path('public/uploads/product_images/'.$file_name));
            }else{
                //delete existing file and move new file to the upload product mage directory
                unlink(base_path('public/uploads/product_images/'.$current_img_file));
                Image::make($image_to_update)->resize(400,450)->save(base_path('public/uploads/product_images/'.$file_name));
            }

            //update the product image
            Product::findOrFail($request->id)->update([
                'product_image' => $file_name
            ]);
        }

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
        $current_img_file = Product::findOrFail($id)->product_image;
        if ($current_img_file !== 'default_product_image.jpg'){
            unlink(base_path('public/uploads/product_images/'.$current_img_file));
        }
        Product::withTrashed()
            ->where('id',$id)
            ->forceDelete();
        return back()->with('restore_status','Product Permanently Deleted');
    }
}
