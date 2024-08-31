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
</style>


<!-- ========== Start about-us-section ========== -->
<div class="container">
  <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1"><i class="nav-icon fas fa-user"></i> My Profile</span>
    </div>
  </nav>
  <div class="row">
    <div class="col-12">

      @if (count($errors) > 0)
         <div class = "alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif

      <form name="save_track" method="post" action="{{route('profile.update')}}" style="padding-left: 12px;">
          @csrf
          
          <div class="form-group">
              <label for="exampleFormControlSelect1">First Name</label>
              <input value="{{auth()->user()->first_name}}" type="text" class="form-control" id="first_name" name="first_name">
          </div>

          <div class="form-group">
              <label for="exampleFormControlSelect1">Last Name</label>
              <input value="{{auth()->user()->last_name}}" type="text" class="form-control" id="last_name" name="last_name">
          </div>

          <div class="form-group">
              <label for="exampleFormControlSelect1">Email</label>
              <input value="{{auth()->user()->email}}" type="text" class="form-control" id="email" name="email">
          </div>

          <div class="form-group">
              <label for="exampleFormControlSelect1">Phone</label>
              <input value="{{auth()->user()->phone_number}}" type="text" class="form-control" id="phone_number" name="phone_number">
          </div>

          <div class="form-group">
              <label for="exampleFormControlSelect1">Password</label>
              <input autocomplete="new-password" type="password" class="form-control" id="password" name="password">
          </div>

          <div class="form-group">
              <label for="exampleFormControlSelect1">Confirm Password</label>
              <input autocomplete="new-password" type="password" class="form-control" id="password_confirmation" name="password_confirmation">
          </div>

          <button type="submit" class="btn btn-primary">Update</button>

      </form>
    </div>
  </div>
</div>
@endsection