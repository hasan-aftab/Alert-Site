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
            <h1>Pages List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Pages</li>
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
                <h3 class="card-title"><a href="{{url('admin/pages/add/new')}}">Add New Page</a></h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                @if(count($pages)>0)
                    @foreach($pages as $blog)

                            <div class="row">

                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th class="col-sm-2 col-md-2">Title</th>

                                            <th class="col-sm-3 col-md-3"  style="text-align: right;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>

                                            <td class="col-sm-2 col-md-2">

                                                <div class="media">
                                                    <div class="media-body">
                                                        <h4  class="product-title" ><a href="#">{{$blog->title}}</a></h4>

                                                        <span>Created at :  </span><span class="text-success"><strong>{{$blog->created_at}}</strong></span>
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="col-sm-3 col-md-3" style="text-align: right">
                                              <a style="display: none;" href="/admin/pages/remove/{{$blog->id}}" class="btn btn-danger">Remove</a>
                                              <a href="/admin/pages/edit/{{$blog->id}}" class="btn btn-primary">EDIT</a>
                                            </td>
                                        </tr>
                                        </tbody>
                                      </table>
                            </div>
                        @endforeach
                    @else
                        <h6 class="display-8">THERE'S NO Page<BR><a href="/admin/pages/add/new">ADD Page </a>  </h6>

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
        @if ($pages->previousPageUrl())
            <a href="{{ $pages->previousPageUrl() }}"><< Previous</a>
        @endif
        
        @if ($pages->nextPageUrl())
          &nbsp;&nbsp;&nbsp;<a href="{{ $pages->nextPageUrl() }}">Next >></a>
        @endif
    </div>
@endsection