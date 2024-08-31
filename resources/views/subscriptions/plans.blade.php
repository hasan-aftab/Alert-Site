@extends('frontend.layout.homepagenew')

@section('content')

    <style>

        .monthly {
            font-size: 200px;
            margin-top:0;
        }

        .container {
            margin-bottom: 50px;
        }

        .section-title h1 {
            font-weight: bold;
            text-align: center;
            margin-bottom: 0;
        }

        .single-pricing {
            background: #fff;
            padding: 40px 20px;
            border-radius: 5px;
            position: relative;
            z-index: 2;
            border: 1px solid #eee;
            box-shadow: 0 10px 40px -10px rgba(0, 64, 128, .09);
            transition: 14.3s;
        }

        .single-pricing:hover {
            box-shadow: 0px 60px 60px rgba(0, 0, 0, 0.1);
            z-index: 100;
            transform: translate(0, -10px);
        }

        .single-pricing-white {
            background: #232434;
        }

        /* Price Label */
        .price-label {
            color: #fff;
            background: #ffaa17;
            font-size: 25px;
            width: 100px;
            margin-bottom: 15px;
            display: block;
            -webkit-clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
            clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
            margin-left: -20px;
            position: absolute;
        }

        /* Price Head */
        .price-head {
            margin-bottom: 20px;
        }

        .price-head h2 {
            font-weight: 600;
            margin-bottom: 0;
            text-transform: capitalize;
            font-size: 26px;
        }

        .price-head span {
            display: inline-block;
            background: #ffaa17;
            width: 6px;
            height: 6px;
            border-radius: 30px;
            margin-bottom: 20px;
            margin-top: 15px;
        }

        /* Price */
        .price {
            font-weight: 500;
            font-size: 50px;
            margin-bottom: 0;
        }

        /* Pricing Features */
        .single-pricing ul {
            list-style: none;
            margin-bottom: 20px;
            margin-top: 30px;
        }

        .single-pricing ul li {
            line-height: 35px;
            font-weight: bold;
        }

        /* Pricing Links */
        .single-pricing a {
            background: none;
            border: 2px solid #ffaa17;
            border-radius: 5000px;
            color: #ffaa17;
            display: inline-block;
            font-size: 16px;
            overflow: hidden;
            padding: 10px 45px;
            text-transform: capitalize;
            transition: all 0.3s ease 0s;
        }

        .single-pricing a:hover,
        .single-pricing a:focus {
            background: #ffaa17;
            color: #fff;
            border: 2px solid #ffaa17;
        }

        .pricing-content {
        }

        .single-pricing {
            background: #fff;
            padding: 40px 20px;
            border-radius: 5px;
            position: relative;
            z-index: 2;
            border: 1px solid #eee;
            box-shadow: 0 10px 40px -10px rgba(0, 64, 128, .09);
            transition: 14.3s;
        }

        @media only screen and (max-width: 480px) {
            .single-pricing {
                margin-bottom: 30px;
            }
        }

        .single-pricing:hover {
            box-shadow: 0px 60px 60px rgba(0, 0, 0, 0.1);
            z-index: 100;
            transform: translate(0, -10px);
        }

        .price-label {
            color: #fff;
            background: #ffaa17;
            font-size: 16px;
            width: 115px;
            margin-bottom: 15px;
            display: block;
            -webkit-clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
            clip-path: polygon(100% 0%, 90% 50%, 100% 100%, 0% 100%, 0 50%, 0% 0%);
            margin-left: -20px;
            position: absolute;
        }

        .price-head h2 {
            font-weight: 600;
            margin-bottom: 0px;
            text-transform: capitalize;
            font-size: 26px;
        }

        .price-head span {
            display: inline-block;
            background: #ffaa17;
            width: 6px;
            height: 6px;
            border-radius: 30px;
            margin-bottom: 20px;
            margin-top: 15px;
        }

        .price {
            font-weight: 500;
            font-size: 50px;
            margin-bottom: 0px;
        }

        .single-pricing {
        }

        .single-pricing h5 {
            font-size: 18px;
            margin-bottom: 0px;
            text-transform: uppercase;
        }

        .single-pricing ul {
            list-style: none;
            margin-bottom: 20px;
            margin-top: 30px;
        }

        .single-pricing ul li {
            line-height: 35px;
        }

        .single-pricing a {
            background: none;
            border: 2px solid #ffaa17;
            border-radius: 5000px;
            color: #ffaa17;
            display: inline-block;
            font-size: 16px;
            overflow: hidden;
            padding: 10px 45px;
            text-transform: capitalize;
            transition: all 0.3s ease 0s;
        }

        .single-pricing a:hover, .single-pricing a:focus {
            background: #ffaa17;
            color: #fff;
            border: 2px solid #ffaa17;
        }

        .single-pricing-white {
            background: #232434
        }

        .single-pricing-white ul li {
            color: #fff;
        }

        .single-pricing-white h2 {
            color: #fff;
        }

        .single-pricing-white h1 {
            color: #fff;
        }

        .single-pricing-white h5 {
            color: #fff;
        }

        .native-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        .native-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

		.plan-row .col-lg-4 {
			width: 30.66%;
			background: border-box;
			padding: 0 15px;
		}
		.plan-row .row {
			display: flex;
			flex-wrap: wrap;
			/* gap: 30px; */
			box-sizing: border-box;
			margin-left: -15px;
			margin-right: -15px;
		}
		.single-pricing {
			border: 1px solid #000;
		}
		@media only screen and (max-width:767px){
			.plan-row .col-lg-4 {
				width: 100%;
			}
			
		.single-pricing .form-control-add {
			padding-right: 0;
		}

		.single-pricing .form-control-add input#submit {
			margin: 0 auto;
		}

		.single-pricing ul, .single-pricing ul li {
			padding: 0 !important;
		}

		.price-label {
			margin-top: -30px;
			font-size: 16px !important;
			padding: 4px 0;
			width: 80px;
		}
		}
    </style>

    <section class="main-section full-container">
        <div class="container flex l-gap flex-mobile lr-m">
            <section id="pricing" class="pricing-content section-padding">
                <div class="container">

                    @if(Session::has('success'))
                        <div class="alert native-success" role="alert">
                            {!! session('success') !!}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert native-error" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if(session('cancel'))
                        <div class="alert native-success" role="alert">
                            {{ session('cancel') }}
                        </div>
                    @endif
                    @if(session('unable'))
                        <div class="alert native-error" role="alert">
                            {{ session('unable') }}
                        </div>
                    @endif
                    @if(session('plan_error'))
                        <div class="alert native-error" role="alert">
                            You have set your maximum number of alerts. Please visit your <a href="{{route('track.list')}}" target="_blank">My Account</a> page to edit or remove current alerts, or <a href="{{route('plans')}}" target="_blank">UPGRADE YOUR PLAN</a>.
                        </div>
                    @endif

                    
                    <div>
                        <h1 class="page-title">OUR PLANS</h1>
                    </div>

                    @if($currentPlanName)
                        @if($currentPlanName!='free')
                            <p>You are currently subscribed to the <b>{{strtoupper($currentPlanName)}}</b> Plan. To switch to another plan, click on the <b>Get Started</b> button. You will be asked for your credit card information again to agree to the new monthly charge.</p>
                        @else
                            <p>You are currently subscribed to the FREE Plan. To switch to another plan, click on the Get Started button. You will be asked for your credit card information to agree to the new monthly charge</p>
                        @endif
                    <br>
                    @endif
					<div class="plan-row">
                    <div class="row text-center">
                        <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                             data-wow-delay="0.1s" data-wow-offset="0"
                             style="text-align: center;"
                        >
                            <div class="single-pricing">
                                @if($currentPlanName === 'free')
                                    <span style="display:none;"  class="price-label fw-bold pe-2 text-black">Subscribed</span>
                                @endif
                                <div class="price-head">
                                    <h2>Free</h2>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <h1 class="price">$0</h1>
                                <h5 class="monthly">Monthly</h5>
                                <ul>
                                    <li class="fw-bold text-center d-block" style="padding-right: 35px">1 Alert</li>
                                    <li class="fw-bold text-center d-block" style="padding-right: 35px">&nbsp;</li>
                                </ul>
                                @if($user && $userSubscribed && $currentPlanName === 'free')
                                    <div class="form-control-add" style="margin-left:65px;">
                                        <input style="color: white;background-color: #cb1414;" onclick="confirmUnsubscribe('{{ strtoupper($currentPlanName) }}')" type="submit" id="submit" class="l-submit" value="Unsubscribe">
                                    </div>
                                @else
                                <div class="form-control-add" style="margin-left:65px;">
                                    <input onclick="checkPlanAndRedirect('{{ $plansArray['free']->id }}')" type="submit" id="submit" class="l-submit" value="Get Started">
                                </div>
                                @endif
                            </div>
                        </div><!--- END COL -->
                        <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                             data-wow-delay="0.2s" data-wow-offset="0"
                             style="text-align: center"
                        >
                            <div class="single-pricing">
                                @if($currentPlanName === 'basic')
                                    <span style="display:none;"  class="price-label fw-bold pe-2 text-black">Subscribed</span>
                                @endif
                                <div class="price-head">
                                    <h2>Basic</h2>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <h1 class="price">$3.99</h1>
                                <h5 class="monthly">Monthly</h5>
                                <ul>
                                    <li class="fw-bold text-center d-block" style="padding-right: 35px">5 Alerts</li>
                                    <li class="fw-bold text-center d-block" style="padding-right: 35px">&nbsp;</li>
                                </ul>
                                @if($user && $userSubscribed && $currentPlanName === 'basic')
                                    <div class="form-control-add" style="margin-left:65px;">
                                        <input style="color: white;background-color: #cb1414;" onclick="confirmUnsubscribe('{{ strtoupper($currentPlanName) }}')" type="submit" id="submit" class="l-submit" value="Unsubscribe">
                                    </div>
                                @else

                                <div class="form-control-add" style="margin-left:65px;">
                                    <input onclick="checkPlanAndRedirect('{{ $plansArray['basic']->id }}')" type="submit" id="submit" class="l-submit" value="Get Started">
                                </div>

                                <a style="display:none" href="{{ route('plan.detail', [$plansArray['basic']->id]) }}">
                                    Get Started
                                </a>
                                @endif
                            </div>
                        </div><!--- END COL -->
                        
                        <div class="col-lg-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-duration="1s"
                             data-wow-delay="0.3s" data-wow-offset="0"
                             style="text-align: center"
                        >
                            <div class="single-pricing single-pricing-white">
                                <span class="price-label text-black" style="font-size: 25px;">Best</span>
                                @if($currentPlanName === 'premium')
                                    <span style="display:none;" class="price-label fw-bold pe-2 text-black">Subscribed</span>
                                @endif
                                <div class="price-head">
                                    <h2>Premium</h2>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>                                
                                <h1 class="price">$9.99</h1>
                                <h5 class="monthly">Monthly</h5>
                                <ul>
                                    <li class="fw-bold text-center d-block" style="padding-right: 35px">Unlimited Alerts</li>
                                    <li class="fw-bold text-center d-block" style="padding-right: 35px">Top 20 Deals</li>
                                </ul>
                                @if($user && $userSubscribed && $currentPlanName === 'premium')
                                    <div class="form-control-add" style="margin-left:65px;">
                                        <input style="color: white;background-color: #cb1414;" onclick="confirmUnsubscribe('{{ strtoupper($currentPlanName) }}')" type="submit" id="submit" class="l-submit" value="Unsubscribe">
                                    </div>
                                @else

                                <div class="form-control-add" style="margin-left:65px;">
                                    <input onclick="checkPlanAndRedirect('{{ $plansArray['premium']->id }}')" type="submit" id="submit" class="l-submit" value="Get Started">
                                </div>
                                @endif
                            </div>
                        </div><!--- END COL -->
                    </div><!--- END ROW -->
                    </div>
                </div><!--- END CONTAINER -->
            </section>
        </div>
    </section>
@endsection

<script>
    function confirmUnsubscribe(planName) {
        //var current_plan = "{{$currentPlanName}}";
        //if(current_plan){
        //    alert('Before you can sign up for another plan, you must unsubscribe from your current plan.');
        //    return false;
        //}

        var confirmationMessage = "Are you sure you want to unsubscribe from the " + planName + " plan? All of your alerts will be deleted and you will not be refunded for the reminder of your month. We suggest canceling right before renewal.";
        
        if (confirm(confirmationMessage)) {
            window.location.href = "{{ route('subscription-cancel') }}";
        } else {
            // Optionally handle if user cancels
            // For example, you can prevent default form submission:
            // event.preventDefault();
        }
    }

    function checkPlanAndRedirect(planId) {
        var current_plan = "{{ $currentPlanName }}";

        if (current_plan) {
            alert('Before you can sign up for another plan, you must unsubscribe from your current plan.');
            return false;
        } else {
            window.location.href = '{{ url('plan') }}/' + planId;
        }
    }
</script>
