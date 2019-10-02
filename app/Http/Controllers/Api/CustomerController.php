<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Customer::all();
        //return CustomerResource::collection(Customer::latest()->paginate(10));
        return new CustomerCollection(Customer::orderBy('id','DESC')->paginate(10));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Customer::validateCustomer($request);

        $customer = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'total' => $request->total,
            'address' => $request->address,
        ];
        Customer::insert($customer);

        //or you can use
        /*$customer_obj = new Customer();
        $customer_obj->name = $request->name;
        $customer_obj->email = $request->email;
        $customer_obj->phone = $request->phone;
        $customer_obj->address = $request->address;
        $customer_obj->save();*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CustomerResource(Customer::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Customer::validateCustomer($request);

        $customer = Customer::findOrFail($id);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * search customer by a specific field and the value of that field
     *
     * @param $field
     * @param $query
     * @return CustomerCollection
     */
    public function SearchCustomer($field,$query){
        return new CustomerCollection(
            Customer::where($field,'LIKE',"%$query%")
                ->latest()
                ->paginate(10)
        );
    }
}
