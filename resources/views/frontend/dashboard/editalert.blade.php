@extends('frontend.layout.homepagenew')
@section('content')
    <section class="main-section full-container">
        <div class="container flex l-gap flex-mobile lr-m">
            
            @includeIf('frontend.layout.sidebar')
            <div class="page-content home">
                <h1 class="page-title">Edit Alert</h1>
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
                        <div class="alert alert-danger">
                            <ul>
                                @php
                                    $displayedErrors = [];
                                @endphp

                                @foreach ($errors->all() as $error)
                                    @if ($error === 'The amount field is required.')
                                        @if (!in_array($error, $displayedErrors))
                                            <li>{{ $error }}</li>
                                            @php
                                                $displayedErrors[] = $error;
                                            @endphp
                                        @endif
                                    @else
                                        <li>{{ $error }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div  class="alert alert-danger" role="alert" style="">
                            {{ session('error') }}
                        </div><br>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success" style="color: green;font-size: 18px;">
                            {{ session('success') }}
                        </div><br>
                    @endif

                    <div class="cmn-form">
                    <style>
                        .selectpicker option {
                            border: none;
                            background-color: white;
                            outline: none;
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            color: black;
                            font-size: 1rem;
                            margin: 0;
                            padding-left: 0;
                            margin-top: -20px;
                            background: none;
                        }

                        select.selectpicker {
                            border: none;
                            background-color: #FFFFFF !important;
                            outline: none;
                            -webkit-appearance: none;
                            -moz-appearance: none;
                            color: black;
                            height: 2.5rem;
                            font-size: 1rem;
                            margin: 0;
                            padding-left: 0.7rem;
                            padding-top: 3px !important;
                            padding-bottom: 3px !important;
                            margin-top: -20px;
                            background: none;
                            width: 76.5%;
                        }
                        .alert {
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

                        #select2-store-container{
                            padding-top: 12px !important;
                        }

                        .select2-selection{
                            height: 50px !important;
                        }

                        .selection{
                            height: 35px !important;
                        }

                        .select2-container{
                           
                            height: 43px !important;
                        }
                    </style>

                    <form name="save_track" method="post" action="{{route('track.update', $alert->id)}}">
                        @csrf
                        
                        <input type="hidden" value="{{$alert->store_id}}" id="current_store_id" name="current_store_id">

                        <div class="form-control-input">
                            <label style="margin-bottom: 0px;">STORE:
                            </label>
                            <select name="store" id="store" class="l-store selectpicker">
                                <option value="" disabled selected>Loading Stores...</option>
                            </select>
                        </div>

                        <div class="form-control-input" style="display:none;">
                            <label>OPERATOR:
                            </label>
                            <select class="l-operator" id="operator" name="operator">
                                <option selected value=">">Greater than</option>
                                <option value="==">Equal to</option>
                            </select>
                        </div>

                        <div class="form-control-input">
                            <label>AMOUNT:
                            </label>
                            <select style="" class="l-operator" id="discount_type" name="discount_type">
                                <option value="">--Select--</option>
                                <option {{$alert->discount_type=='Percentage'?'selected':''}} value="Percentage">Percent Cash Back</option>
                                <option {{$alert->discount_type=='Fixed'?'selected':''}} value="Fixed">Fixed Cash Back</option>
                            </select>
                            &nbsp;
                            <input type="text" value="{{$alert->price}}" class="l-operator form-control" placeholder="Enter Amount" id="price" name="price" oninput="this.value = this.value.replace(/[^\d.]/g, '').replace(/^(\d{0,3})(\.\d{0,2})?.*$/, '$1$2');">

                        </div>
                        

                        <input type="hidden" value="track_page" name="track_page">
                        
                        <div class="form-control-atype">
                            <label style="width: 37%;">ALERT TYPE:</label>
                            <div style="padding-left: 0px;">

                                <div class="box-container">
                                    <input type="radio" value="email" name="alert_type" id="alert_checkbox[]"
                                        class="l-alert_checkbox" onclick="singleSelection(this)" 
                                        {{ $alert->alert_email == 'email' && $alert->alert_text != 'text' ? 'checked' : '' }}>
                                    <div class="box-label">Email</div>
                                    </div>
                                    <div class="box-container">
                                        <input type="radio" value="text" name="alert_type" id="alert_checkbox[]"
                                            class="l-alert_checkbox" onclick="singleSelection(this)"
                                            {{ $alert->alert_text == 'text' && $alert->alert_email != 'email' ? 'checked' : '' }}>
                                        <div class="box-label">Text/SMS*</div>
                                    </div>
                                    <div class="box-container">
                                    <input type="radio" value="both" name="alert_type" id="alert_checkbox[]"
                                        class="l-alert_checkbox" onclick="singleSelection(this)" 
                                        {{ $alert->alert_email == 'email' && $alert->alert_text == 'text' ? 'checked' : '' }}>
                                    <div class="box-label">Both</div>
                                </div>

                                <span class="footer_note"><i>*US Customers only. Automated alert messages will be sent to the phone number provided. Msg and data rates may apply. Msg frequency may vary. To opt out, text "STOP"</i></span>
                            </div>
                            <br>
                        </div>

                        <div class="form-control-alert-on" style="display:none;">
                            <div class="alert-lable-container">
                             <label>ALERT:
                             </label>
                            </div>

                            <div class="alert-input-switcher" style="display:none;">
                                <label class="switch">
                                    <input type="checkbox" id="status" name="status" class="l-alert_on" checked value="1">
                                    <div class="slider round">
                                        <div class="on-label">ON</div>
                                        <div class="off-label">OFF</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="form-control-add">
                            <input type="submit" id="submit" class="l-submit" value="Update">
                        </div>
                    </form>  
                    
                    <br><br>
                    @if(count($all_tracks) > 0)
                    <div class="cmn-table">	
                        <table class="content-table" style="border-collapse: collapse; margin: 26px 29px; font-size: 0.9em; min-width: 400px; border-radius: 5px 5px 0 0; overflow: hidden; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);">
                                <thead style="background-color: #95bb3c; color: #000000; text-align: left; font-weight: bold;">
                                    <tr>
                                        <th style="padding: 12px 15px;">#</th>
                                        <th style="padding: 12px 15px;">Store Name</th>
                                        <th style="padding: 12px 15px;">Operator</th>
                                        <th style="padding: 12px 15px;">Discount Type</th>
                                        <th style="padding: 12px 15px;">Amount</th>
                                        <th style="padding: 12px 15px;">Alert Type</th>
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
                                            <td style="padding: 12px 15px;">{{$track->price}}</td>
                                            <td style="padding: 12px 15px;">{!! $track->alert_email ? $track->alert_email . '<br>' : '' !!} {{$track->alert_text}}</td>
                                            <td style="padding: 12px 15px;    font-size: 20px;"><a title="Edit Track" href="{{route('editalert',$track->id)}}" style="text-decoration: none;color: inherit;">&#9998;</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </div>
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

    setTimeout(() => {
        $('#store').val($('#current_store_id').val()).trigger('change');
    }, 1000);
</script>

@includeIf('frontend.layout.hero-section')

@endsection

