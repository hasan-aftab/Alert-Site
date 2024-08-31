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
            <h1>Blog Reviews List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Reviews</li>
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
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                @if(count($blogs)>0)
                    @foreach($blogs as $blog)

                            <div class="row">

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th class="col-sm-2 col-md-2">Review</th>

                                            <th class="col-sm-2 col-md-2">Rating</th>

                                            <th class="col-sm-2 col-md-2">Status</th>

                                            <th class="col-sm-3 col-md-3"  style="text-align: right;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>

                                            <td class="col-sm-2 col-md-2">

                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4  class="product-title" ><a href="#">{{$blog->review}}</a></h4>

                                                        <span>Created at :  </span><span class="text-success"><strong>{{$blog->created_at}}</strong></span>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="col-sm-2 col-md-2">

                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4  class="product-title" ><a href="#">{{$blog->rate}} star(s)</a></h4>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="col-sm-2 col-md-2">

                                                <div class="media">
                                                    <div class="media-body">
                                                        @if($blog->status==0)
                                                            In-Active
                                                        @else
                                                            Active
                                                        @endif
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="col-sm-3 col-md-3" style="text-align: right">
                                              
                                              @if($blog->status==0)
                                                <a href="/admin/blogs/moderate/changestatus/{{$blog->id}}/1" class="btn btn-primary">Change Status</a>
                                              @else
                                                <a href="/admin/blogs/moderate/changestatus/{{$blog->id}}/0" class="btn btn-primary">Change Status</a>
                                              @endif
                                            </td>
                                        </tr>
                                        </tbody>
                                      </table>
                            </div>
                        @endforeach
                    @else
                        <h6 class="display-8">THERE'S NO REVIEWS</h6>

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
        @if ($blogs->previousPageUrl())
            <a href="{{ $blogs->previousPageUrl() }}"><< Previous</a>
        @endif
        
        @if ($blogs->nextPageUrl())
          &nbsp;&nbsp;&nbsp;<a href="{{ $blogs->nextPageUrl() }}">Next >></a>
        @endif
    </div>
@endsection