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
            <h1>Orders List</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
               <li class="breadcrumb-item active">Orders</li>
            </ol>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
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
               @if(count($orders)>0)
               
               <div class="row">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>#ID</th>
                           <th>Customer</th>
                           <th>Amount</th>
                           <th>Stripe Payment ID</th>
                           <th>Purchased On</th>
                        </tr>
                     </thead>
                     <tbody>

                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->amount}}</td>
                                <td>{{$order->payment_intent_id}}</td>
                                <td>{{$order->created_at}}</td>
                            </tr>
                        @endforeach

                     </tbody>
                  </table>
               </div>
               @else
               <h6 class="display-8">THERE'S NO ORDER</h6>
               @endif
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
   </div>
</section>
<div class="pagination">
        @if ($orders->previousPageUrl())
            << <a href="{{ $orders->previousPageUrl() }}">Previous</a>
        @endif
        
        @if ($orders->nextPageUrl())
            &nbsp;&nbsp;&nbsp;<a href="{{ $orders->nextPageUrl() }}">Next >></a>
        @endif
</div>
@endsection