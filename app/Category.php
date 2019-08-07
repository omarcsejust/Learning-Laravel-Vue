<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Category extends Model
{
    public static function validateCategory(Request $request){
        $request->validate([
            'category_name' => 'required|regex:/^[a-zA-Z]+$/u|unique:categories,category_name'
        ]);
    }
}
