@extends('admin.layout.main')

@section('content')

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create New Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pages</li>
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
            <form method="post" enctype="multipart/form-data" action="{{ route('admin.pages.store') }}">
                @csrf
                <div class="mb-3 mt-3">
                  <label for="product_name">Title:</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title">
                </div>

                <div class="mb-3 mt-3">
                  <label for="product_name">Description:</label>
                  <textarea name="description" cols="5" id="description" class="form-control"></textarea>
                </div>

                <div class="mb-3 mt-3">
                  <label for="image">Feature Image:</label>
                  <input type="file" class="form-control" id="feature_image" name="feature_image">
                </div>

                <div class="mb-3 mt-3" style="display:none;">
                  <label for="image">Blog Image:</label>
                  <input type="file" class="form-control" id="blog_image" name="blog_image">
                </div>

                <div class="mb-3 mt-3">
                  <label for="meta_title">Meta Title:</label>
                  <input class="form-control" id="meta_title" rows="6" placeholder="Enter Meta Title" name="meta_title"></textarea>
                </div>

                <div class="mb-3 mt-3">
                  <label for="meta_title">Meta Keywords:</label>
                  <input class="form-control" id="meta_keywords" rows="6" placeholder="Enter Meta Keywords" name="meta_keywords"></textarea>
                </div>

                <div class="mb-3 mt-3">
                  <label for="meta_title">Meta Description:</label>
                  <textarea name="meta_description" class="form-control"></textarea>
                </div>              
                <button type="submit" class="btn btn-primary">Create</button>
              </form>
          </div>
        </div>
        <br>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
@endsection