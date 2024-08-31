@extends('frontend.layout.dashboard')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<style>
    .container {
        padding: 2rem 15px;
    }

    h4 {
        margin: 2rem 0rem 1rem;
    }

    .table-image {
        td, th {
            vertical-align: middle;
        }
    }

    .back-button {
      display: block;
      width: auto;
		padding: 5px 15px;
      height: 40px;
      margin: 0px 0 0;
      background-color: #95bb3c;
      border-radius: 6px;
      color: #fff;
      font-weight: 500;
      margin-left: 12px;
      cursor: pointer;
    }
.track-list-adm {
    overflow-x: auto;
    padding: 0 0 15px;
}
@media only screen and (max-width:767px){
.track-list-adm table th {
    font-size: 14px;
    line-height: normal;
}
.track-list-adm table td {
    font-size: 14px;
    line-height: normal;
}	
}
</style>


<!-- ========== Start about-us-section ========== -->
<div class="container" style="max-width: 1230px;">
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"><i class="nav-icon fas fa-walking"></i> My Alert(s)</span>
        <span class="navbar-brand mb-0 h1"><a href="{{route('track.add')}}"><i class="nav-icon fas fa-plus"></i> Add New</a></span>
    </div>
  </nav>
  <div class="track-list-adm">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Store</th>
            <th scope="col">Store Name</th>
            <th scope="col">Discount Type</th>
            <th scope="col">Amount</th>
            <th scope="col">Operator</th>
            <th scope="col">Alert Type</th>
            <th scope="col">Created On</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @if($tracks->count() > 0) 
            @foreach($tracks as $track) 
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$track->store_id}}</td>
                    <td>{{$track->store_name}}</td>
                    <td>{{$track->discount_type=='Fixed'?'Cash back':'Percentage'}}</td>  
                    <td>{{$track->price}}</td>
                    <td>{{$track->operator=='>' ? 'Greater than' : ''}} {{$track->operator=='==' ? 'Equal to' : ''}} {{$track->operator=='>=' ? 'Greator to or Equal to' : ''}}</td>
                    
                    <td>{{$track->alert_email ? $track->alert_email.',':''}} {{$track->alert_text}}</td>
                    <td>{{$track->created_at}}</td>
                    <td><a href="{{route('track.edit',$track->id)}}">Edit</a> | <a onclick="return confirm('Are you sure ?')" href="{{route('track.destroy',$track->id)}}">Delete</a></td>
                </tr>
            @endforeach
          @else
            <tr>
                <td colspan="6" style="text-align: center;">No record found </td>
            </tr> 
          @endif  
        </tbody>
      </table>      
      &nbsp;&nbsp;&nbsp;&nbsp;
      <button class="back-button" onclick="window.location.href='/track'">Back to TrackRak</button>
  </div>
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        @if ($tracks->previousPageUrl())
            <a href="{{ $tracks->previousPageUrl() }}"><< Previous</a>
        @endif
        
        @if ($tracks->nextPageUrl())
            <a href="{{ $tracks->nextPageUrl() }}">Next >></a>
        @endif
    </div>
  </nav>
</div>
@endsection