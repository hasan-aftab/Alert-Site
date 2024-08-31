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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Faqs List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Faqs</li>
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
                <h3 class="card-title"><a href="{{url('admin/faq/add/new')}}">Add New Faq</a></h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                
                    <table id="sortable-table" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-sm-2 col-md-2">ID</th>
                                        <th class="col-sm-2 col-md-2">Title</th>
                                        <th class="col-sm-3 col-md-3" style="text-align: right;">Action</th>
                                    </tr>
                                </thead>
                    <tbody>
                    @if(count($faqs)>0)
                    @foreach($faqs as $key=>$blog)

                           

                           
                              
                                    <tr data-id="{{$blog->id}}">
                                        <td class="col-sm-2 col-md-2">
                                           {{ $key+1 }}
                                        </td>
                                        <td class="col-sm-2 col-md-2">
                                           {{ $blog->title }}
                                        </td>
                                        <td class="col-sm-3 col-md-3" style="text-align: right">
                                           <a href="{{url('/admin/faq/edit/')}}/{{$blog->id}}">Edit</a> |
                                           <a href="{{url('/admin/faq/remove/')}}/{{$blog->id}}">Delete</a>
                                        </td>
                                    </tr>
                                    <!-- Additional table rows -->
                              
                          

                          
                        @endforeach
                    @else
                        <h6 class="display-8">THERE'S NO FAQS</h6>

                     @endif
                    </tbody>
                    </table>
                </div>

              


              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
      </div>
    </section>
     <!-- Previous and Next buttons -->
     <div class="pagination">
        @if ($faqs->previousPageUrl())
            <a href="{{ $faqs->previousPageUrl() }}"><< Previous</a>
        @endif
        
        @if ($faqs->nextPageUrl())
          &nbsp;&nbsp;&nbsp;<a href="{{ $faqs->nextPageUrl() }}">Next >></a>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sortable-table tbody").sortable({
                update: function(event, ui) {
                    // Get the updated order of elements
                    var newOrder = $(this).sortable('toArray', { attribute: 'data-id' });

                    // Update the order in the FAQ table using Ajax
                    $.ajax({
                        url: '/admin/faq/update_order',
                        method: 'POST',
                        data: { order: newOrder, _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            // Handle success
                            console.log('Order updated successfully');
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error('Error updating order:', error);
                        }
                    });
                }
            });
        });
    </script>
@endsection