@extends('frontend.layout.dashboard')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<style>
    .container {
        padding: 2rem 0rem;
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
</style>


<!-- ========== Start about-us-section ========== -->
<div class="container">
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"><i class="nav-icon fas fa-walking"></i> My Alert(s)</span>
        <span class="navbar-brand mb-0 h1"><a href="{{route('track.list')}}"><i class="fas fa-arrow-left"></i>Back</a></span>
    </div>
  </nav>
  <div class="row">
    <div class="col-12">

      @if (count($errors) > 0)
         <div class="alert alert-danger" role="alert" style="">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif

      <form name="update_track" method="post" action="{{route('track.update', $track->id)}}" style="padding-left: 10px;">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlSelect1">Store</label>
            <select class="selectpicker form-control" name="store" id="store" data-live-search="true">
              @foreach($stores as $store)
                <option {{$track->store_id==$store->store_id ? 'selected':''}} value="{{$store->store_id}}">{{$store->store_name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group" style="display:none;">
              <label for="exampleFormControlSelect1">Operator</label>
              <select class="form-control" id="operator" name="operator">
                  <option {{$track->operator=='>' ? 'selected':''}} value=">">Greater than</option>
                  <option {{$track->operator=='==' ? 'selected':''}} value="==">Equal to</option>                  
              </select>
          </div>

          <label for="exampleFormControlSelect1">Amount</label>
          <div class="form-group" style="display: flex;">
            
            <select class="form-control" id="discount_type" name="discount_type" style="width: 40%;">
              <option {{$track->discount_type=='Fixed' ? 'selected':''}}>Fixed</option>
              <option {{$track->discount_type=='Percentage' ? 'selected':''}}>Percentage</option>
            </select>

            &nbsp;&nbsp;&nbsp;
            <input type="text" class="form-control" value="{{$track->price}}" id="price" name="price" style="width: 40%;" oninput="this.value = this.value.replace(/[^\d.]/g, '').replace(/^(\d{0,3})(\.\d{0,2})?.*$/, '$1$2');">
          </div>
          
          <div class="form-group">
              <label for="exampleFormControlSelect1">Alert Type</label>
              <div class="form-check">
                <input class="form-check-input" {{$track->alert_email=='email' ? 'checked':''}} type="checkbox" value="email" name="alert_email" id="alert_email">
                <label class="form-check-label" for="flexRadioDefault1">
                  Email
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" {{$track->alert_text=='text' ? 'checked':''}} type="checkbox" value="text" name="alert_text" id="alert_text">
                <label class="form-check-label" for="flexRadioDefault2">
                  SMS
                </label>
              </div>
          </div>
          <div class="form-group" style="display:none;">
              <label for="exampleFormControlSelect1">ALERT</label>
              <select class="form-control" id="status" name="status">
                  <option value="1" {{$track->status=='1' ? 'selected':''}}>On</option>
                  <option value="0" {{$track->status=='0' ? 'selected':''}}>Off</option>
              </select>
          </div>

          <style>

              .track-form-submit-btn:hover {
                  cursor: pointer;
              }

              [data-tooltip]:before {
                  content: attr(data-tooltip);
                  position: absolute;
                  opacity: 0;
                  bottom:42px;
                  left: -30px;
                  transition: 256ms all ease;
                  padding: 3px 20px 3px 20px;
                  color: white;
                  border-radius: 5px;
                  box-shadow: 0px 6px 21px rgb(0 0 0 / 10%);
              }

              [data-tooltip]:hover:before {
                  opacity: 1;
                  background: black;
                  border-radius: 5px;
                  border: 1px solid #ccc;
              }
          </style>
          <button type="submit" class="back-button" @if(!auth()->user()->subscribed()) data-tooltip="Please buy a plan"  disabled @endif>Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection
