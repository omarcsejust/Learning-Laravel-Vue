@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- List of All Product Grid --}}
            <div class="col-8">
                <div class="card">
                    <div class="card-header bg-success">
                        All Product List
                    </div>
                    <div class="card-body">
                        @if(session('delete_status'))
                            <div class="alert alert-danger">{{session('delete_status')}}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Desc</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->product_name  }}</td>
                                    <td>{{ $product->product_description  }}</td>
                                    <td>{{ $product->product_price  }}</td>
                                    <td>{{ $product->product_quantity  }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ url('product/delete')  }}/{{ $product->id  }}" class="btn btn-danger">Delete</a>
                                            <a href="{{ url('product/update/form')  }}/{{ $product->id  }}" class="btn btn-info">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-danger text-center">
                                    <td colspan="5">Data Not Available!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $products->links()  }}
                    </div>
                </div>
            </div>

            {{-- Add product Grid --}}
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

                        @if($errors->all())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error  }}</li>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{url('product/add')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Name</label>
                                <input type="text" class="form-control" placeholder="Add Product" name="product_name" value="{{old('product_name')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Description</label>
                                <textarea name="product_description" class="form-control" rows="3">{{old('product_description')}}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Price</label>
                                <input type="text" class="form-control" placeholder="Product Price" name="product_price" value="{{old('product_price')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Quantity</label>
                                <input type="text" class="form-control" placeholder="Product Quantity" name="product_quantity" value="{{old('product_quantity')}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Alert Quantity</label>
                                <input type="text" class="form-control" placeholder="Alert Quantity" name="product_alert_quantity" value="{{old('product_alert_quantity')}}">
                            </div>

                            <button type="submit" name="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection