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
            <h1>User(s) List</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{url('/admin')}}">Home</a></li>
               <li class="breadcrumb-item active">Customers</li>
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
               @if(count($customers)>0)
               <div class="row">
                  <table class="table table-hover">
                     <thead>
                        <tr>
                           <th>Sr. no.</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Registration On</th>
                           <th class="text-center">Plan</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>

                        @foreach($customers as $index => $customer)
                            <tr>
                                <td>{{$index + $customers->firstItem()}}</td>
                                <td>{{$customer->first_name . ' ' . $customer->last_name }}</td>
                                <td>{{$customer->email}}</td>
                                <td>{{$customer->created_at}}</td>
                                <td class="justify-content-center text-center">
                                @if($customer->subscribed())
                                    
                                 @php
                                    $subscription = $customer->subscription('default');
                                    if ($subscription) {
                                       $currentSubscribedPlanPriceId = $subscription->stripe_price;

                                       $currentPlan = \App\Models\Plans::where('stripe_id', $currentSubscribedPlanPriceId)->first();
                                       $currentPlanName = @$currentPlan->identifier;
                                    }
                                 @endphp

                                    {{ucfirst($currentPlanName)}}
                                @else
                                    
                                @endif
                                </td>
                                <td><a onclick="return confirm('Are you sure?')" href="{{url('admin/customer/delete')}}/{{$customer->id}}"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        @endforeach

                     </tbody>
                  </table>
               </div>
               @else
                    <h6 class="display-8">THERE'S NO Customer</h6>
               @endif
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
    </div>
   </div>
</section>
<div class="pagination">
        @if ($customers->previousPageUrl())
            << <a href="{{ $customers->previousPageUrl() }}">Previous</a>
        @endif

        @if ($customers->nextPageUrl())
            &nbsp;&nbsp;&nbsp;<a href="{{ $customers->nextPageUrl() }}">Next >></a>
        @endif
</div>
@endsection
