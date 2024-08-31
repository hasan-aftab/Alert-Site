@extends('frontend.layout.homepagenew')
@section('content')
    <section class="main-section full-container">
        <div class="container flex l-gap flex-mobile lr-m">
            
            @includeIf('frontend.layout.dashboardsidebar')
            @if(count($all_tracks)==0)
                <div class="page-content home" style="height: 555px;">
            @else
                <div class="page-content home" style="height: 555px;">
            @endif

                <h1 class="page-title">My Alerts</h1>
                <div class="cmn-form">

                    <style>
                        .alert-danger {
                            color: #721c24;
                            background-color: #f8d7da;
                            border-color: #f5c6cb;
                        }

                        .alert {
                            padding: 2px;
                            margin-bottom: 50px;
                            border: 1px solid transparent;
                            border-radius: 4px;
                        }
                    </style>

                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert" style="">
                            {{ session('error') }}
                        </div><br>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success" style="color: green;font-size: 18px;">
                            {{ session('success') }}
                        </div><br>
                    @endif

                    @if(count($all_tracks) > 0)
                        <div class="cmn-table">	
                            <table class="content-table" style="border-collapse: collapse; margin: 26px 29px; font-size: 0.9em; min-width: 400px; border-radius: 5px 5px 0 0; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
                                    <thead style="background-color: #95bb3c; color: #000000; text-align: left; font-weight: bold;">
                                        <tr>
                                            <th style="padding: 12px 15px;">#</th>
                                            <th style="padding: 12px 15px;">Store Name</th>
                                            <th style="padding: 12px 15px;">Operator</th>
                                            <th style="padding: 12px 15px;">Discount Type</th>
                                            <th style="padding: 12px 15px;">Alert Type</th>
                                            <th style="padding: 12px 15px;">Amount</th>
                                            <th style="padding: 12px 15px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_tracks as $key=>$track)
                                            <tr style="border-bottom: 1px solid #030303;">
                                                <td style="padding: 12px 15px;">{{$key+1}}</td>
                                                <td style="padding: 12px 15px;">{{$track->store_name}}</td>
                                                <td style="padding: 12px 15px;">{{$track->operator=='>' ? 'Greater than' : ''}} {{$track->operator=='==' ? 'Equal to' : ''}} {{$track->operator=='>=' ? 'Greater to or Equal to' : ''}}</td>
                                                <td style="padding: 12px 15px;">{{$track->discount_type=='Fixed'?'Cash back':'Percentage'}}</td>
                                                <td style="padding: 12px 15px;"> {{ $track->alert_email ? $track->alert_email . ',' : '' }} {{ $track->alert_text }}</td>
                                                <td style="padding: 12px 15px;">{{$track->price}}</td>
                                                <td style="padding: 12px 15px;    font-size: 20px;"><a title="Edit Track" href="{{route('editalert',$track->id)}}" style="color: inherit;">&#9998;</a> <a href="{{url('track/remove')}}/{{$track->id}}" onclick="return confirm('Are you sure?')" title="Delete Track" style="color: inherit;">&times;</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                        </div>

                        
                    @else

                        @if($currentPlanName)
                            <p style="text-align: center;
                            text-decoration: underline;
                                ">No alerts found!</p>
                        @else
                            <p style="text-align: center;
                            text-decoration: underline;
                                ">No alerts found! In order to start tracking, <b><a href="{{route('plans')}}">SIGN UP FOR A PLAN</a></b>.</p>
                        @endif
                    @endif

                </div>
            </div>
        </div>
</section>
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

@includeIf('frontend.layout.hero-section')

@endsection

