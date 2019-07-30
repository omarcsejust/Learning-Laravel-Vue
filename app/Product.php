<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Product extends Model
{
    use SoftDeletes;

    //which fields you can update
    protected $fillable = ['product_name','product_description','product_price','product_quantity','product_alert_quantity'];

    public static function validateModel(Request $request){
        $request->validate(
            [
                'product_name' => 'required',
                'product_description' => 'required',
                'product_price' => 'required|numeric',
                'product_quantity' => 'required|integer',
                'product_alert_quantity' => 'required|integer',
            ]
        );
    }

}
