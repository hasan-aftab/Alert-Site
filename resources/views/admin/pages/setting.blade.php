@extends('admin.layout.main')

@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Setting</li>
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
            <form method="post" enctype="multipart/form-data" action="{{ route('setting.store') }}">
                @csrf
                <div class="mb-3 mt-3">
                  <label for="product_name">Email:</label>
                  <input type="email" class="form-control" value="{{$rec->email}}" id="email" placeholder="Enter Email" name="email">
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Phone:</label>
                 <input type="text" maxlength="13" class="form-control" value="{{$rec->phone}}" name="phone" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);">
                </div>

                <div class="mb-3 mt-3" style="display: none;">
                  <label for="image">Logo:</label>
                  <input type="file" class="form-control" id="logo" name="logo">
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Email Content:</label>
                  <textarea name="email_content" cols="2" id="email_content" class="form-control">{{$rec->email_content}}</textarea>
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">SMS Content:</label>
                  <textarea name="sms_content" cols="2" id="sms_content" class="form-control">{{$rec->sms_content}}</textarea>
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Email Content Background Color:</label>
                  <input type="color" class="form-control" value="{{$rec->background_color}}" name="background_color">
                </div>
         
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
          </div>
        </div>
        <br>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
@endsection