<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    protected $fillable = ['product_name','product_description','product_price','product_quantity','product_alert_quantity'];

    public static function validateModel(Request $request){
        $request->validate(
            [
                'product_name' => 'required',
                'product_description' => 'required',
                'product_price' => 'required',
                'product_quantity' => 'required',
                'product_alert_quantity' => 'required',
            ]
        );
    }

}
