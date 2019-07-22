@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Update product Grid --}}
            <div class="col-6 offset-3">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('product/form')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name  }}</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-header bg-success">
                        Update Product
                    </div>
                    <div class="card-body">

                        @if(session('update_status'))
                            <div class="alert alert-success">
                                {{ session('update_status') }}
                            </div>
                        @endif

                        <form action="{{url('product/update')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{ $product->id  }}">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" placeholder="Add Product" name="product_name" value="{{ $product->product_name  }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Description</label>
                                <textarea name="product_description" class="form-control" rows="3">{{ $product->product_description  }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Price</label>
                                <input type="text" class="form-control" placeholder="Product Price" name="product_price" value="{{ $product->product_price  }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Quantity</label>
                                <input type="text" class="form-control" placeholder="Product Quantity" name="product_quantity" value="{{ $product->product_quantity  }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Alert Quantity</label>
                                <input type="text" class="form-control" placeholder="Alert Quantity" name="product_alert_quantity" value="{{ $product->product_alert_quantity  }}">
                            </div>

                            <button type="submit" name="submit" class="btn btn-info">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection