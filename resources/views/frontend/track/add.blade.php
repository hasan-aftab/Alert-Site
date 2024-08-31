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

      <form name="save_track" method="post" action="{{route('track.save')}}" style="padding-left: 10px;">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlSelect1">Store</label>
            <select class="selectpicker form-control" name="store" id="store" data-live-search="true">
              <option value="" disabled selected>Type store name</option>
              @foreach($stores as $store)
                <option value="{{$store->store_id}}">{{$store->store_name}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group" style="display:none;">
              <label for="exampleFormControlSelect1">Operator</label>
              <select class="form-control" id="operator" name="operator">
                  <option selected value=">">Greater than</option>
                  <option value="==">Equal to</option>                  
              </select>
          </div>

          <label for="exampleFormControlSelect1">Amount</label>
          <div class="form-group" style="display: flex;">
            <select class="form-control" id="discount_type" name="discount_type" style="width: 40%;">
              <option value="">--Select--</option>
              <option>Fixed</option>
              <option>Percentage</option>
            </select>&nbsp;&nbsp;&nbsp;
            <input type="text" class="form-control" id="price" name="price" style="width: 40%;" oninput="this.value = this.value.replace(/[^\d.]/g, '').replace(/^(\d{0,3})(\.\d{0,2})?.*$/, '$1$2');">
          </div>
          
          <div class="form-group">
              <label for="exampleFormControlSelect1">Alert Type</label>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="email" name="alert_email" id="alert_email">
                <label class="form-check-label" for="flexRadioDefault1">
                  Email
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="text" name="alert_text" id="alert_text">
                <label class="form-check-label" for="flexRadioDefault2">
                  SMS
                </label>
              </div>
          </div>
          <div class="form-group" style="display:none;">
              <label for="exampleFormControlSelect1">ALERT</label>
              <select class="form-control" id="status" name="status">
                  <option value="1">On</option>
                  <option value="0">Off</option>
              </select>
          </div>
          <button type="submit" class="back-button">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection