@extends('admin.layout.main')

@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif


          <div class="col-md-12">
            <form method="post" enctype="multipart/form-data" action="{{ url('/admin/products/update/'.$product->id) }}">
                
                @csrf
                <div class="mb-3 mt-3">
                  <label for="product_name">Printful Product Name:</label>
                  <input type="text" value="{{$product->product_name}}" class="form-control" id="product_name" placeholder="Enter Printful Product Name" name="product_name">
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Website Product Name:</label>
                  <input type="text" value="{{$product->website_product_name}}" class="form-control" id="website_product_name" placeholder="Enter Webstie Product Name" name="website_product_name">
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Product Price:</label>
                  <input type="number" value="{{$product->product_price}}" class="form-control" id="product_price" placeholder="Enter Product Price" name="product_price">
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Product Description:</label>
                  <textarea class="form-control" id="product_description" rows="6" placeholder="Enter Product Description" name="product_description">{{$product->product_description}}</textarea>
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Commission (%):</label>
                  <input type="number" value="{{$product->commission}}" class="form-control" id="commission" placeholder="Enter Commission" name="commission">
                </div>

                <div class="mb-3">
                  <label for="pwd">Supporting Country:</label>                  
                  <select class="form-control" id="supporting_country" name="supporting_country">
                    <option value="">Select</option>
                    <option {{$product->supporting_country=='Israel'?'selected':''}} value="Israel">Israel</option>
                    <option {{$product->supporting_country=='Palestine'?'selected':''}}  value="Palestine">Palestine</option>
                    <option {{$product->supporting_country=='Azerbaijan'?'selected':''}}  value="Azerbaijan">Azerbaijan</option>
                    <option {{$product->supporting_country=='Armenia'?'selected':''}}  value="Armenia">Armenia</option>
                    <option {{$product->supporting_country=='Russia'?'selected':''}}  value="Russia">Russia</option>
                    <option {{$product->supporting_country=='Ukraine'?'selected':''}}  value="Ukraine">Ukraine</option>
                    <option {{$product->supporting_country=='Turkey'?'selected':''}}  value="Turkey">Turkey</option>
                    <option {{$product->supporting_country=='Kurdistan'?'selected':''}}  value="Kurdistan">Kurdistan</option>
                    <option {{$product->supporting_country=='India'?'selected':''}}  value="India">India</option>
                    <option {{$product->supporting_country=='Pakistan'?'selected':''}}  value="Pakistan">Pakistan</option>
                  </select>
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Product Category:</label>
                  <select class="form-control" id="product_for" name="product_for">
                    <option value="">Select</option>
                    <option {{$product->product_for=='Men'?'selected':''}}  value="Men">Men</option>
                    <option {{$product->product_for=='Woman'?'selected':''}}  value="Woman">Woman</option>
                    <option {{$product->product_for=='Accessories'?'selected':''}}  value="Accessories">Accessories</option>
                  </select>
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Product Type:</label>
                  <select class="form-control" id="product_type" name="product_type">
                    <option value="">Select</option>
                    <option {{$product->product_type=='Shirts'?'selected':''}}  value="Shirts">Shirts</option>
                    <option {{$product->product_type=='Hoodies'?'selected':''}}  value="Hoodies">Hoodies</option>
                    <option {{$product->product_type=='Sweatshirts'?'selected':''}}  value="Sweatshirts">Sweatshirts</option>
                    <option {{$product->product_type=='Bottoms'?'selected':''}}  value="Bottoms">Bottoms</option>
                    <option {{$product->product_type=='Hats'?'selected':''}} value="Hats">Hats</option>
                    <option {{$product->product_type=='Headwear'?'selected':''}} value="Headwear">Headwear</option>
                    <option {{$product->product_type=='Footwear'?'selected':''}} value="Footwear">Footwear</option>
                    <option {{$product->product_type=='Bags'?'selected':''}} value="Bags">Bags</option>
                    <option {{$product->product_type=='Phone Cases'?'selected':''}} value="Phone Cases">Phone Cases</option>
                  </select>
                </div>

                <div class="mb-3 mt-3" style="display:none">
                  <label for="title">Product Sub Type:</label>
                  <select class="form-control" id="product_sub_type" name="product_sub_type">
                    <option value="">Select</option>
                    <option {{$product->product_sub_type=='Oversized'?'selected':''}}  value="Oversized">Oversized</option>
                    <option {{$product->product_sub_type=='Fitted'?'selected':''}}  value="Fitted">Fitted</option>
                    <option {{$product->product_sub_type=='V-Neck'?'selected':''}}  value="V-Neck">V-Neck</option>
                    <option {{$product->product_sub_type=='Long Sleeve'?'selected':''}}  value="Long Sleeve">Long Sleeve</option>
                    <option {{$product->product_sub_type=='Polo'?'selected':''}}  value="Polo">Polo</option>
                  </select>
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Front Image:</label>
                  <input type="file" class="form-control" name="front_image">
                  @if($product->front_image)
                      <a target="_blank" href="{{fileToUrl($product->front_image)}}">View Front Image</a>
                  @endif
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Front Image Price:</label>
                  <input type="text" value="{{$product->front_image_price}}" class="form-control" name="front_image_price">
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Front Image Donation Description:</label>
                  <textarea class="form-control" name="front_image_donation">{{$product->front_image_donation}}</textarea>
                </div>

                <div class="mb-3 mt-3" style="display:none">
                  <label for="title">Back Image:</label>
                  <input type="file" class="form-control" name="back_image">
                  @if($product->back_image)
                      <a target="_blank" href="{{fileToUrl($product->back_image)}}">View Front Image</a>
                  @endif
                </div>
                
                <div class="mb-3 mt-3">
                  <label for="title">Back Image Price:</label>
                  <input type="text" value="{{$product->back_image_price}}" class="form-control" name="back_image_price">
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Back Image Donation:</label>
                  <textarea class="form-control" name="back_image_donation">{{$product->back_image_price}}</textarea>
                </div>

                <div class="mb-3 mt-3" style="display:none">
                  <label for="title">Right Image:</label>
                  <input type="file" class="form-control" name="right_image">
                  @if($product->right_image)
                      <a target="_blank" href="{{fileToUrl($product->right_image)}}">View Right Image</a>
                  @endif
                </div>

                <div class="mb-3 mt-3" style="display:none">
                  <label for="title">Left Image:</label>
                  <input type="file" class="form-control" name="left_image">
                  @if($product->left_image)
                      <a target="_blank" href="{{fileToUrl($product->left_image)}}">View Front Image</a>
                  @endif
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Seo Title:</label>
                  <input type="text" value="{{$product->seo_title}}" class="form-control" name="seo_title">
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Meta Description:</label>
                  <textarea class="form-control" name="meta_description">{{$product->meta_description}}</textarea>
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Meta Keyword:</label>
                  <textarea class="form-control" name="meta_keyword">{{$product->meta_keyword}}</textarea>
                </div>

                <label for="title">Product Diemsion:</label>
                <div class="mb-3" style="display: flex;width: 1143px;">
                  <input type="text" value="{{$product->product_x_axis}}" class="form-control" placeholder="Product X-axis" name="product_x_axis">&nbsp;&nbsp;<input type="text" value="{{$product->product_y_axis}}" class="form-control" placeholder="Product Y-axis" name="product_y_axis">&nbsp;&nbsp;<input type="text" value="{{$product->product_width}}" class="form-control" placeholder="Product Width" name="product_width">&nbsp;&nbsp;<input type="text" value="{{$product->product_height}}" class="form-control" placeholder="Product Height" name="product_height">
                </div>

                <div class="mb-3 mt-3">
                  <label for="title">Collection Type:</label>
                  <select class="form-control" id="collections_type" name="collections_type">
                    <option {{$product->collections_type=='Collections'?'selected':''}} value="Collections">Collections</option>
                    <option {{$product->collections_type=='Cause Collection'?'selected':''}} value="Cause Collection">Cause Collection</option>
                    <option {{$product->collections_type=='Advocacy Collection'?'selected':''}} value="Advocacy Collection">Advocacy Collection</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary">UPDATE</button>
              </form>
          </div>
        </div>
        <br>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
@endsection