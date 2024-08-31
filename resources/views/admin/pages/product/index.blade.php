@extends('admin.layout.main')

@section('content')
      <style>
        /* Example styles for pagination */
        .pagination {
          font-size: 21px;
          /* padding: 43px; */
          float: inline-end;
          padding-right: 18px;
        }

        .pagination ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .pagination ul li {
            display: inline;
            margin-right: 5px;
        }

        .pagination ul li a {
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .pagination ul li a.active {
            background-color: #007bff;
            color: white;
        }
    </style>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
    
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><a href="{{url('admin/products/create')}}">Add New Product</a></h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                @if(count($products)>0)
                    @foreach($products as $product)

                            <div class="row">

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th class="col-sm-2 col-md-2">Product</th>

                                            <th class="col-sm-2 col-md-2">Commission</th>

                                            <th class="col-sm-2 col-md-2">Price</th>

                                            <th class="col-sm-1 col-md-1">Country</th>

                                            <th class="col-sm-3 col-md-3"  style="text-align: right;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>

                                            <td class="col-sm-2 col-md-2">

                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4  class="product-title" ><a  href="/products/{{$product->id}} ">{{$product->product_name}}</a></h4>

                                                        <span>Created at :  </span><span class="text-success"><strong>{{$product->created_at}}</strong></span>
                                                    </div>

                                                </div>
                                            </td>

                                            <th class="col-sm-2 col-md-2"> {{$product->commission}}$</th>
                                            <td class="col-sm-2 col-md-2"><strong>  {{$product->product_price}}$</strong></td>
                                            <td class="col-sm-1 col-md-1"><strong>  {{$product->supporting_country}}</strong></td>
                                            <td class="col-sm-3 col-md-3" style="text-align: right">
                                              <a href="/admin/products/remove/{{$product->id}}" class="btn btn-danger">Remove</a>
                                              <a href="/admin/products/{{$product->id}}/edit" class="btn btn-primary">EDIT</a>
                                              <a href="/admin/products/create_template/{{$product->id}}" class="btn btn-primary">Design Templates</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                      </table>
                            </div>
                        @endforeach
                    @else
                        <h6 class="display-8">THERE'S NO PRODUCT<BR><a href="/admin/products/create">ADD PRODUCT </a>  </h6>

                @endif
                </div>

              


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
    </section>
     <!-- Previous and Next buttons -->
     <div class="pagination">
        @if ($products->previousPageUrl())
            <a href="{{ $products->previousPageUrl() }}"><< Previous</a>
        @endif
        
        @if ($products->nextPageUrl())
          &nbsp;&nbsp;&nbsp;<a href="{{ $products->nextPageUrl() }}">Next >></a>
        @endif
    </div>
@endsection