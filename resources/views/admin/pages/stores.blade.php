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
            <h1>Stores List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Stores</li>
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
              <!-- /.card-header -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                @if(count($rec)>0)
                    

                            <div class="row">

                                    <table id="example" class="display">
        <thead>
            <tr>
               
                <th>Store Id</th>
                <th>Store Name</th>
                <th>Amount</th>
                <th>Discount Type</th>
                <th>Site URL</th>
                <th>Shopping URL</th>
            </tr>
        </thead>
        <tbody>
          @foreach($rec as $blog)
            <tr>
                
                <td>{{$blog->store_id}}</td>
                <td>{{$blog->store_name}}</td>
                <td>{{$blog->amount}}</td>
                <td>{{$blog->display}}</td>
                <td>{{$blog->site_url}}</td>
                <td>{{$blog->shopping_url}}</td>
            </tr>
          @endforeach
            
        </tfoot>
    </table>
                            </div>
                       
                    @else
                        <h6 class="display-8">THERE'S NO Stores</h6>

                @endif
                </div>

              


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
    </section>
    
@endsection