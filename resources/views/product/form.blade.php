@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-success">
                        All Product List
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Desc</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">#</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->product_name  }}</td>
                                    <td>{{ $product->product_description  }}</td>
                                    <td>{{ $product->product_price  }}</td>
                                    <td>{{ $product->product_quantity  }}</td>
                                    <td>#</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $products->links()  }}
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-header bg-success">
                        Add Product
                    </div>
                    <div class="card-body">

                        @if(session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{url('product/add')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" placeholder="Add Product" name="product_name">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Description</label>
                                <textarea name="product_description" class="form-control" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Price</label>
                                <input type="text" class="form-control" placeholder="Product Price" name="product_price">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Quantity</label>
                                <input type="text" class="form-control" placeholder="Product Quantity" name="product_quantity">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Alert Quantity</label>
                                <input type="text" class="form-control" placeholder="Alert Quantity" name="product_alert_quantity">
                            </div>

                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection