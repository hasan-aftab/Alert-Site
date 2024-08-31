<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{env('APP_NAME2')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('/')}}/asset/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{url('/')}}/asset/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('/')}}/asset/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('/')}}/asset/admin/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/asset/admin/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('/')}}/asset/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('/')}}/asset/admin/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('/')}}/asset/admin/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="icon" href="{{ asset('asset/frontend/images/favicon.png') }}" type="image/x-icon">

  <style>
    .alert{
      padding: 2px;
      margin-bottom: 50px;
      border: 1px solid transparent;
      border-radius: 4px;
    }

    .alert-danger {
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
    }
  </style>

  @includeIf('frontend.layout.analytic')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  

  <!-- /.navbar -->

  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: cadetblue;">
  <a href="{{url('/')}}/track"><img src="{{ asset('asset/frontend/test/images/trackrak-logo.png') }}" class="branding" alt="TrackRak logo" style="
    max-width: 190px;
    width: auto;
    height: auto;
    margin: 11px;
"></a>
    <a href="{{url('/')}}/my_account" class="brand-link">
      <span style="font-size: 18px;" class="brand-text font-weight-light">Welcome {{auth()->user()->first_name}} {{auth()->user()->last_name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">

            <a href="{{url('/track')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-globe"></i>
              <p>
                View Site
              </p>
            </a>

            <a href="{{url('/myprofile')}}" class="nav-link {{$activeLink=='myprofile'?'active':''}}">
              <i class="nav-icon fas fa-user"></i>
              <p>
                My Profile
              </p>
            </a>

            <a href="{{url('/track/list')}}" class="nav-link {{$activeLink=='track'?'active':''}}">
              <i class="nav-icon fas fa-walking"></i>
              <p>
                My Alert(s)
              </p>
            </a>

            <a href="{{url('/plans')}}" class="nav-link {{$activeLink=='plans'?'active':''}}">
              <i class="nav-icon fas fa-hourglass"></i>
              <p>
                 Edit Plan 
              </p>
            </a>

            <a href="{{url('/logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <div class="content-wrapper">
    <!-- Main content -->
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
  &copy; {{ date('Y') }} TrackRak, All Rights Reserved | <a href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a> | <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
</div>
 <!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('/')}}/asset/admin/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/')}}/asset/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/asset/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{url('/')}}/asset/admin/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{url('/')}}/asset/admin/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{url('/')}}/asset/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{url('/')}}/asset/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('/')}}/asset/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('/')}}/asset/admin/plugins/moment/moment.min.js"></script>
<script src="{{url('/')}}/asset/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{url('/')}}/asset/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{url('/')}}/asset/admin/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{url('/')}}/asset/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/asset/admin/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('/')}}/asset/admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/')}}/asset/admin/dist/js/demo.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<style>
  .selectpicker option
  {
          border: none;
          background-color: white;
          outline: none;
          -webkit-appearance: none;
          -moz-appearance : none;
          color: #14B1B2;
          font-weight: bold;
          font-size: 30px;
          margin: 0;
          padding-left: 0;
          margin-top: -20px;
          background: none;
      }
  select.selectpicker
  {
          border: none;
          background-color: white;
          outline: none;
          -webkit-appearance: none;
          -moz-appearance : none;
          color: #14B1B2;
          font-weight: bold;
          font-size: 30px;
          margin: 0;
          padding-left: 0;
          margin-top: -20px;
          background: none;
  }
</style>

<script>
        document.getElementById('store').addEventListener('change', function() {
            var storeId = this.value;
            if (storeId) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/check_store/' + storeId, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if(!response.exist){
                           alert(response.message);
                        }
                        // You can further handle the response here
                    } else {
                        alert('Request failed. Please try again later.');
                    }
                };
                xhr.send();
            }
        });
</script>

</body>
</html>
