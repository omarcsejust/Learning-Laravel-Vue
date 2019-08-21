<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Customer extends Model
{
    //use SoftDeletes;

    //allow user to update this fields
    protected $fillable = [
        'name',
        'email',
        'phone',
        'total',
        'address',
    ];
    //validate customer
    public static function validateCustomer(Request $request){
        return $request->validate([
            'name' => 'required',
            'email' => 'required|unique:customers,email',
            'phone' => 'required|unique:customers,phone',
            'address' => 'required',
            'total' => 'required|numeric',
        ]);
    }
}
