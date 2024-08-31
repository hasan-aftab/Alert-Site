@extends('frontend.layout.homepagelayout')

@section('content')

<style type="text/css">
    .pricing-table .pricing-price {
      font-size:40px;
    }


    .pricing-table .panel-primary > .panel-heading {
      background-color:#222;
      background-image:none;
      color:white;
      font-weight:bold;
    }

    a.btn.btn-primary.button:hover {
      background-color:#fff;
      color:black;
      transition:0.7s ease-out;
      border:1px solid #000;
    }

    a.btn.btn-primary.button {
      width:100%;
      border:1px solid #000;
    }

    .pricing-table {
      -webkit-transition:all .3s ease;
      -moz-transition:all .3s ease;
      -ms-transition:all .3s ease;
      -o-transition:all .3s ease;
      transition:all .3s ease;
      -webkit-transform:translate(0px,0px);
      -moz-transform:translate(0px,0px);
      -ms-transform:translate(0px,0px);
      -o-transform:translate(0px,0px);
      transform:translate(0px,0px);
    }

    .pricing-table:hover {
      -webkit-transform:translate(0px,-10px);
      -moz-transform:translate(0px,-10px);
      -ms-transform:translate(0px,-10px);
      -o-transform:translate(0px,-10px);
      transform:translate(0px,-10px);
    }

    li.list-group-item {
      text-align:center;
      text-transform:capitalize;
    }

    span.text-lowercase.pricing-duration {
      font-size:20px;
    }

    #pricing2 p.lead.text-nowrap.text-uppercase.text-center.pricing-price {
      font-size:35px;
    }

    a.btn.btn-primary {
      background-image:none;
      background-color:#222;
      box-shadow:none;
      text-transform:uppercase;
      letter-spacing:2px;
      font-size:12px;
      border-radius:0px;
      border:0px;
      padding:10px 0px;
    }

    #pricing2 .panel-primary > .panel-heading {
      background-color:#222;
      background-image:none;
      font-family:'proxima nova', sans-serif;
    }

    li.list-group-item {
      font-family:'proxima nova', sans-serif;
    }

    div.panel.panel-primary {
      border-color:#000;
    }

    a:hover, a:focus {
      text-decoration:none;
    }
</style>

<!-- ========== Start Support the Cause ========== -->
<section class="Support-Cause">
    <div class="container">
        <h4>Pricing<br></h4>
    </div>
</section>
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
<div id="pricing-tables">
    <div class="container" style="padding:50px;">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12 pricing-table">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="text-nowrap text-uppercase text-center panel-title">Free option</h3></div>
                    <div class="panel-body">
                        <p class="lead text-nowrap text-uppercase text-center pricing-price" style="margin-bottom:0;"><sup>$</sup>0<span class="text-lowercase pricing-duration">/mo </span> </p>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><span>user can set one alert</span></li>
                    </ul>
                    <div class="panel-footer"><a class="btn btn-primary button" role="button" href="{{url('/plan')}}/3">Subscribe</a></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 pricing-table">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="text-nowrap text-uppercase text-center panel-title">Monthly option</h3></div>
                    <div class="panel-body">
                        <p class="lead text-nowrap text-uppercase text-center pricing-price" style="margin-bottom:0;"><sup>$</sup>4.99<span class="text-lowercase pricing-duration">/mo </span> </p>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><span>up to 5 alerts</span></li>
                    </ul>
                    <div class="panel-footer"><a class="btn btn-primary button" role="button" href="{{url('/plan')}}/1" style="width:100%;font-family:&#39;proxima nova&#39;, sans-serif;">Subscribe</a></div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12 pricing-table" style="/*padding:0px 50px;*/">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="text-nowrap text-uppercase text-center panel-title">Monthly option </h3></div>
                    <div class="panel-body">
                        <p class="lead text-nowrap text-uppercase text-center pricing-price" style="margin-bottom:0;"><sup>$</sup>9.99<span class="text-lowercase pricing-duration">/mo </span> </p>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><span>up to 10 alerts</span></li>
                    </ul>
                    <div class="panel-footer"><a class="btn btn-primary button" role="button" href="{{url('/plan')}}/2" style="width:100%;font-family:&#39;proxima nova&#39;, sans-serif;">Subscribe</a></div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection