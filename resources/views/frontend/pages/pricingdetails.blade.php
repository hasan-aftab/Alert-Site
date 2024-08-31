@extends('frontend.layout.homepagenew')
@section('content')

    <style type="text/css">
     
        .example.example5 {
            /*   background-color: #333; */
            padding: 5px;
        }

        .example.example5 * {
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 16px;
            font-weight: 400;
        }

        .example.example5 form {
        }

        #example5-paymentRequest {
            max-width: 500px;
            width: 100%;
            margin-bottom: 10px;
        }

        .example.example5 fieldset {
            border: 1px solid #424746;
            padding: 15px;
            border-radius: 6px;
        }

        .example.example5 fieldset legend {
            margin: 0 auto;
            padding: 0 10px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            /*   background-color: #424746; */
        }

        .example.example5 fieldset legend + * {
            clear: both;
        }

        .example.example5 .card-only {
            display: block;
        }

        .example.example5 .payment-request-available {
            display: none;
        }

        .example.example5 .row {
            display: -ms-flexbox;
            display: flex;
            margin: 0 0 10px;
        }

        .example.example5 .field {
            position: relative;
            width: 100%;
        }

        .example.example5 .field + .field {
            margin-left: 10px;
        }

        .example.example5 label {
            width: 100%;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .example.example5 .input {
            width: 100%;
            color: black;
            background: transparent;
            padding: 5px 0 6px 0;
            border-bottom: 1px solid black;
            transition: border-color 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .example.example5 .input::-webkit-input-placeholder {
            color: #676868;
        }

        .example.example5 .input::-moz-placeholder {
            color: #676868;
        }

        .example.example5 .input:-ms-input-placeholder {
            color: #676868;
        }

        .example.example5 .input.StripeElement--focus,
        .example.example5 .input:focus {
            border-color: black;
        }

        .example.example5 .input.StripeElement--invalid {
            border-color: #ffc7ee;
        }

        .example.example5 input:-webkit-autofill,
        .example.example5 select:-webkit-autofill {
            -webkit-text-fill-color: black;
            transition: background-color 100000000s;
            -webkit-animation: 1ms void-animation-out;
        }

        .example.example5 .StripeElement--webkit-autofill {
            background: transparent !important;
        }

        .example.example5 input,
        .example.example5 button,
        .example.example5 select {
            -webkit-animation: 1ms void-animation-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: none;
            border-style: none;
            border-radius: 0;
        }

        .example.example5 select.input,
        .example.example5 select:-webkit-autofill {
            background-image: url('data:image/svg+xml;utf8,<svg width="10px" height="5px" viewBox="0 0 10 5" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill="#fff" d="M5.35355339,4.64644661 L9.14644661,0.853553391 L9.14644661,0.853553391 C9.34170876,0.658291245 9.34170876,0.341708755 9.14644661,0.146446609 C9.05267842,0.0526784202 8.92550146,-2.43597394e-17 8.79289322,0 L1.20710678,0 L1.20710678,0 C0.930964406,5.07265313e-17 0.707106781,0.223857625 0.707106781,0.5 C0.707106781,0.632608245 0.759785201,0.759785201 0.853553391,0.853553391 L4.64644661,4.64644661 L4.64644661,4.64644661 C4.84170876,4.84170876 5.15829124,4.84170876 5.35355339,4.64644661 Z" id="shape"></path></svg>');
            background-position: 100%;
            background-size: 10px 5px;
            background-repeat: no-repeat;
            overflow: hidden;
            text-overflow: ellipsis;
            padding-right: 20px;
        }

        .example.example5 button {
            display: block;
            width: 100%;
            height: 40px;
            margin: 20px 0 0;
            background-color: #95bb3c;
            border-radius: 6px;
            color: #fff;
            font-weight: 500;
            cursor: pointer;
        }

        .example.example5 button:active {
            background-color: #68B4AD;
        }

        .example.example5 button:hover {
            backgroung-color: #68B4AD;
        }

        .example.example5 .error svg .base {
            fill: #fff;
        }

        .example.example5 .error svg .glyph {
            fill: #9169d8;
        }

        .example.example5 .error .message {
            color: #fff;
        }

        .example.example5 .success .icon .border {
            stroke: #bfaef6;
        }

        .example.example5 .success .icon .checkmark {
            stroke: #fff;
        }

        .example.example5 .success .title {
            color: #fff;
        }

        .example.example5 .success .message {
            color: #cdd0f8;
        }

        .example.example5 .success .reset path {
            fill: #fff;
        }

        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        /* This css is for normalizing styles. You can skip this. */
        .example *, *:before, *:after {
          -webkit-box-sizing: border-box;
          -moz-box-sizing: border-box;
          box-sizing: border-box;
          margin: 0;
          padding: 0;
        }

        .example .form-group {
          display: block;
          margin-bottom: 15px;
        }

        .example .form-group input {
          padding: 0;
          height: initial;
          width: initial;
          margin-bottom: 0;
          display: none;
          cursor: pointer;
        }

        .example .form-group label {
          position: relative;
          cursor: pointer;
        }

        .example .form-group label:before {
          content:'';
          -webkit-appearance: none;
          background-color: transparent;
          border: 2px solid #0079bf;
          box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), inset 0px -15px 10px -12px rgba(0, 0, 0, 0.05);
          padding: 6px;
          display: inline-block;
          position: relative;
          vertical-align: middle;
          cursor: pointer;
          margin-right: 5px;
        }

        .example .form-group input:checked + label:after {
          content: '';
          display: block;
          position: absolute;
          top: 2px;
          left: 6px;
          width: 5px;
          height: 11px;
          border: solid #0079bf;
          border-width: 0 2px 2px 0;
          transform: rotate(45deg);
        }

        .example .text-danger{
            color: red;
        }
    </style>

    <script src="https://js.stripe.com/v3/"></script>

    <div class="loading" hidden id="screen-loader">Loading&#8230;</div>

    

    <section class="Support-Cause custom-margin-top">
        <div class="container">
            <br><br><br><br>
            <h1 class="page-title">PAYMENT<br></h1>

            @if($plan->title=='free')
                <br>
                <span style="color:red;">We need your credit card information, even for our FREE plan. Rest assured, we will not charge anything unless you upgrade to a higher plan!</span>
            @endif

            @if(session('error'))
                <div tyle="color:red;" class="alert native-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="cell example example5">
                <form name="paymentfrm" id="paymentfrm" method="post" action="{{route('subscribe.form')}}">
                    @csrf
                    <div id="example5-paymentRequest">
                        <!--Stripe paymentRequestButton Element inserted here-->
                    </div>
                    <fieldset>
                        <legend class="card-only" data-tid="elements_examples.form.pay_with_card" style="color: black; font-size:1rem; font-weight: bold">Pay with card</legend>
                        <legend class="payment-request-available" data-tid="elements_examples.form.enter_card_manually">Or enter
                            card details
                        </legend>
                        <div class="row" style="display: none;">
                            <div class="field">
                                <label for="example5-name" data-tid="elements_examples.form.name_label" style="color: black; font-weight: bold">Name</label>
                                <input value="{{auth()->user()->first_name . ' ' . auth()->user()->last_name ?? ''}}"
                                       data-client-secret="{{$userIntent->client_secret}}" id="example5-name"
                                       data-tid="elements_examples.form.name_placeholder" class="input" type="text"
                                       placeholder="Jane Doe" required="" autocomplete="name" style="color: black; ">
                            </div>
                        </div>
                        <input type="hidden" name="plan" value="{{$planId}}">
                        <input type="hidden" name="email" id="hidden-email">
                        <div class="row" style="display: none;">
                            <div class="field">
                                <label for="example5-email" data-tid="elements_examples.form.email_label" style="color: black; font-weight: bold">Email</label>
                                <input value="{{auth()->user()->email ?? ''}}" id="visible-email"
                                       data-tid="elements_examples.form.email_placeholder" class="input" type="text"
                                       placeholder="janedoe@gmail.com" required="" autocomplete="email">
                            </div>
                            <div class="field">
                                <label for="example5-phone" data-tid="elements_examples.form.phone_label" style="color: black; font-weight: bold">Phone</label>
                                <input id="example5-phone" data-tid="elements_examples.form.phone_placeholder" class="input"
                                       type="text" placeholder="" required="" autocomplete="tel" style="color: black;">
                            </div>
                        </div>
                        <div data-locale-reversible style="display: none;">
                            <div class="row">
                                <div class="field">
                                    <label for="example5-address"
                                           data-tid="elements_examples.form.address_label" style="color: black; font-weight: bold">Address</label>
                                    <input id="example5-address" data-tid="elements_examples.form.address_placeholder"
                                           class="input" type="text" placeholder="" required=""
                                           autocomplete="address-line1">
                                </div>
                            </div>
                            <div class="row" data-locale-reversible>
                                <div class="field">
                                    <label for="example5-city" data-tid="elements_examples.form.city_label" style="color: black; font-weight: bold">City</label>
                                    <input id="example5-city" data-tid="elements_examples.form.city_placeholder" class="input"
                                           type="text" placeholder="" required="" autocomplete="address-level2">
                                </div>
                                <div class="field">
                                    <label for="example5-state" data-tid="elements_examples.form.state_label" style="color: black; font-weight: bold">State</label>
                                    <input id="example5-state" data-tid="elements_examples.form.state_placeholder"
                                           class="input empty" type="text" placeholder="" required=""
                                           autocomplete="address-level1">
                                </div>
                                <div class="field">
                                    <label for="example5-zip" data-tid="elements_examples.form.postal_code_label" style="color: black; font-weight: bold">ZIP</label>
                                    <input id="example5-zip" data-tid="elements_examples.form.postal_code_placeholder"
                                           class="input empty" type="text" placeholder="" required=""
                                           autocomplete="postal-code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="field">
                                <label for="example5-card" data-tid="elements_examples.form.card_label" style="color: black; font-weight: bold">Card</label>
                                <div id="example5-card" class="input" style="color: black; font-weight: bold"></div>
                                <div id="card-errors" class="text-danger mt-1"></div>
                            </div>
                        </div>


                        @if($plan->title!='free')
                        <div class="row">
                            <div class="field">
                                <label for="example5-card" style="color: black; font-weight: bold">Coupon</label>

                                <div style="display: inline-flex;">
                                    <input style="padding-top: 30px;" id="example5-coupon"
                                            class="input empty coupon" type="text" placeholder="" name="coupon">
                                    <button data-planid="{{$planId}}" style="margin-left: 25px;" id="check-coupon-btn">Apply Coupon</button>
                                </div>

                                <div id="coupon-errors" class="text-danger mt-1"></div> 

                            </div>
                        </div>
                        @endif

                        <div class="new">
                            <div class="form-group">
                              <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions">
                              <label for="terms_and_conditions"></label>By clicking on the Pay button below, you agree to our <span style="cursor:pointer;text-decoration: underline;"  onclick="window.location.href = '{{ route('terms') }}';">Terms & Conditions</span> and have read our <span style="cursor:pointer;text-decoration: underline;"   onclick="window.location.href = '{{ route('privacy_policy') }}';">Privacy Policy</span>.
                            </div>

                            <span class="text-danger" id="terms_and_conditions_error">The agree to Terms and Conditions check box is required.<span>
                        </div>

                        <input type="hidden" name="token" class="token">
                        <input type="hidden" name="planPrice" id="planPrice" class="planPrice" value="{{$planPrice}}">
                        <button type="button" id="checkout-submit-btn" data-tid="elements_examples.form.pay_button">Pay
                            ${{$planPrice}}/month</button>
                    </fieldset>

                    <div class="error" role="alert">
                        <!--             <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 17">
                                      <path class="base" fill="#000" d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>
                                      <path class="glyph" fill="#FFF" d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>
                                    </svg> -->
                        <span class="message"></span></div>
                </form>
                <div class="success">
                    <!--           <div class="icon">
                                <svg width="84px" height="84px" viewBox="0 0 84 84" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <circle class="border" cx="42" cy="42" r="40" stroke-linecap="round" stroke-width="4" stroke="#000" fill="none"></circle>
                                  <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" d="M23.375 42.5488281 36.8840688 56.0578969 64.891932 28.0500338" stroke-width="4" stroke="#000" fill="none"></path>
                                </svg>
                              </div> -->
                    <!--           <h3 class="title" data-tid="elements_examples.success.title">Payment successful</h3> -->
                    <!--           <p class="message"><span data-tid="elements_examples.success.message">Thanks for trying Stripe Elements. No money was charged, but we generated a token: </span><span class="token">tok_189gMN2eZvKYlo2CwTBv9KKh</span></p> -->
                    <!--           <a class="reset" href="#">
                                <svg width="32px" height="32px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                  <path fill="#000000" d="M15,7.05492878 C10.5000495,7.55237307 7,11.3674463 7,16 C7,20.9705627 11.0294373,25 16,25 C20.9705627,25 25,20.9705627 25,16 C25,15.3627484 24.4834055,14.8461538 23.8461538,14.8461538 C23.2089022,14.8461538 22.6923077,15.3627484 22.6923077,16 C22.6923077,19.6960595 19.6960595,22.6923077 16,22.6923077 C12.3039405,22.6923077 9.30769231,19.6960595 9.30769231,16 C9.30769231,12.3039405 12.3039405,9.30769231 16,9.30769231 L16,12.0841673 C16,12.1800431 16.0275652,12.2738974 16.0794108,12.354546 C16.2287368,12.5868311 16.5380938,12.6540826 16.7703788,12.5047565 L22.3457501,8.92058924 L22.3457501,8.92058924 C22.4060014,8.88185624 22.4572275,8.83063012 22.4959605,8.7703788 C22.6452866,8.53809377 22.5780351,8.22873685 22.3457501,8.07941076 L22.3457501,8.07941076 L16.7703788,4.49524351 C16.6897301,4.44339794 16.5958758,4.41583275 16.5,4.41583275 C16.2238576,4.41583275 16,4.63969037 16,4.91583275 L16,7 L15,7 L15,7.05492878 Z M16,32 C7.163444,32 0,24.836556 0,16 C0,7.163444 7.163444,0 16,0 C24.836556,0 32,7.163444 32,16 C32,24.836556 24.836556,32 16,32 Z"></path>
                                </svg>
                              </a> -->
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        'use strict';

        var stripe = Stripe("{{ env('STRIPE_KEY') }}");

        function registerElements(elements, exampleName) {
            var formClass = '.' + exampleName;
            var example = document.querySelector(formClass);

            var form = example.querySelector('form');
            var resetButton = example.querySelector('a.reset');
            var error = form.querySelector('.error');
            var errorMessage = error.querySelector('.message');

            function enableInputs() {
                Array.prototype.forEach.call(
                    form.querySelectorAll(
                        "input[type='text'], input[type='email'], input[type='tel']"
                    ),
                    function (input) {
                        input.removeAttribute('disabled');
                    }
                );
            }

            function disableInputs() {
                Array.prototype.forEach.call(
                    form.querySelectorAll(
                        "input[type='text'], input[type='email'], input[type='tel']"
                    ),
                    function (input) {
                        input.setAttribute('disabled', 'true');
                    }
                );
            }

            function triggerBrowserValidation() {
                // The only way to trigger HTML5 form validation UI is to fake a user submit
                // event.
                var submit = document.createElement('input');
                submit.type = 'submit';
                submit.style.display = 'none';
                form.appendChild(submit);
                submit.click();
                submit.remove();
            }

            // Listen for errors from each Element, and show error messages in the UI.
            var savedErrors = {};
            elements.forEach(function (element, idx) {
                element.on('change', function (event) {
                    if (event.error) {
                        error.classList.add('visible');
                        savedErrors[idx] = event.error.message;
                        errorMessage.innerText = event.error.message;
                    } else {
                        savedErrors[idx] = null;

                        // Loop over the saved errors and find the first one, if any.
                        var nextError = Object.keys(savedErrors)
                            .sort()
                            .reduce(function (maybeFoundError, key) {
                                return maybeFoundError || savedErrors[key];
                            }, null);

                        if (nextError) {
                            // Now that they've fixed the current error, show another one.
                            errorMessage.innerText = nextError;
                        } else {
                            // The user fixed the last error; no more errors.
                            error.classList.remove('visible');
                        }
                    }
                });
            });
        }

        (function () {
            "use strict";

            function showLoader() {
                document.getElementById('screen-loader').removeAttribute('hidden');
            }

            function hideLoader() {
                document.getElementById('screen-loader').setAttribute('hidden', 'true');
            }

            var elements = stripe.elements({
                // Stripe's examples are localized to specific languages, but if
                // you wish to have Elements automatically detect your user's locale,
                // use `locale: 'auto'` instead.
                locale: window.__exampleLocale
            });

            /**
             * Card Element
             */
            var card = elements.create("card", {
                hidePostalCode: true,
                iconStyle: "solid",
                style: {
                    base: {
                        iconColor: "black",
                        color: "black",
                        fontWeight: 400,
                        fontFamily: "Helvetica Neue, Helvetica, Arial, sans-serif",
                        fontSize: "16px",
                        fontSmoothing: "antialiased",

                        "::placeholder": {
                            color: "black"
                        },
                        ":-webkit-autofill": {
                            color: "black"
                        }
                    },
                    invalid: {
                        iconColor: "black",
                        color: "black"
                    }
                }
            });
            card.mount("#example5-card");

            card.addEventListener('change', function (event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const checkoutSubmitBtn = document.getElementById('checkout-submit-btn');
            const terms_and_conditions = document.getElementById('terms_and_conditions');
            const checkbox = document.getElementById('terms_and_conditions');

            document.getElementById('terms_and_conditions_error').style.display = 'none';

            checkoutSubmitBtn.addEventListener('click', async (e) => {
                if(!checkbox.checked){
                    document.getElementById('terms_and_conditions_error').style.display = 'inline';
                    return;
                }

                document.getElementById('terms_and_conditions_error').style.display = 'none';
                showLoader();
                e.preventDefault();
                var name = document.getElementById('visible-email');
                const clientSecret = document.getElementById('example5-name').getAttribute('data-client-secret');
                console.log(clientSecret);
                const {setupIntent, error} = await stripe.confirmCardSetup(
                    clientSecret, {
                        payment_method: {
                            card: card,
                            billing_details: {name: name.value}
                        },
                    }
                );
                if (error) {
                    hideLoader();
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = error.message;
                } else {
                    paymentMethodHandler(setupIntent.payment_method);
                }

                function paymentMethodHandler(payment_method) {
                    var subscriptionForm = document.getElementById('paymentfrm');
                    var visibleEmail = document.getElementById('visible-email');
                    var hiddenEmail = document.getElementById('hidden-email');
                    hiddenEmail.value = visibleEmail.value;
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'payment_method';
                    hiddenInput.value = payment_method;
                    hiddenEmail.appendChild(hiddenInput);
                    subscriptionForm.submit();
                }
            });

            /**
             * Payment Request Element---how much they pay
             */
            var paymentRequest = stripe.paymentRequest({
                country: "US",
                currency: "usd",
                total: {
                    amount: 2500,
                    label: "Total"
                },
                requestShipping: true,
                shippingOptions: [
                    {
                        id: "free-shipping",
                        label: "Free shipping",
                        detail: "Arrives in 5 to 7 days",
                        amount: 0
                    }
                ]
            });

            paymentRequest.on("token", function (result) {
                var example = document.querySelector(".example5");
                example.querySelector(".token").innerText = result.token.id;
                example.classList.add("submitted");
                result.complete("success");
            });

            var paymentRequestElement = elements.create("paymentRequestButton", {
                paymentRequest: paymentRequest,
                style: {
                    paymentRequestButton: {
                        theme: "light"
                    }
                }
            });

            paymentRequest.canMakePayment().then(function (result) {
                if (result) {
                    document.querySelector(".example5 .card-only").style.display = "none";
                    document.querySelector(
                        ".example5 .payment-request-available"
                    ).style.display =
                        "block";
                    paymentRequestElement.mount("#example5-paymentRequest");
                }
            });

            registerElements([card], "example5");
        })();
    </script>

    <script>
        let typingTimer;
        const doneTypingInterval = 1000; // milliseconds (1 second)

        // Event listener for click event on checkout button
        document.getElementById('check-coupon-btn').addEventListener('click', async () => {
            const planId = event.target.dataset.planid;
            validateCoupon(planId);
        });

        // Function to validate coupon
        async function validateCoupon(planId) {
            const couponInput = document.getElementById('example5-coupon');
            const couponValue = couponInput.value.trim();

            if (couponValue === "") {
                // Clear any previous error messages
                document.getElementById('coupon-errors').innerText = '';
                return false;
            }

            // Disable the coupon input field
            couponInput.disabled = true;

            // Display a message indicating coupon validation is in progress
            document.getElementById('coupon-errors').innerText = 'Please wait, checking coupon...';

            typingTimer = setTimeout(async () => {
                try {
                    const response = await fetch('/check_coupon', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token if you're using it
                        },
                        body: JSON.stringify({ coupon: couponValue,plan: planId })
                    });

                    const data = await response.json();

                    if (response.ok) {
                        // Coupon validation succeeded, update UI accordingly
                        console.log('Coupon is valid:', data);
                        document.getElementById('coupon-errors').innerText = data.message;

                        // Update the displayed price if a discount is applied
                        if (data.valid && data.discount > 0) {
                            const originalPrice = parseFloat(document.getElementById('planPrice').value); // Retrieve original price
                            let discountedPrice;

                            if (data.discount_type === 'fixed_amount') {
                                // If the discount is a fixed amount
                                discountedPrice = originalPrice - (parseFloat(data.discount) / 100); // Adjusted price after discount
                                document.getElementById('checkout-submit-btn').innerText = `Pay $${discountedPrice.toFixed(2)}/month`;
                            } else {
                                // If the discount is a percentage
                                discountedPrice = originalPrice * (1 - (parseFloat(data.discount) / 100)); // Adjusted price after discount

                                if(data.discount==100){
                                    document.getElementById('checkout-submit-btn').innerText = `Pay $${discountedPrice.toFixed(2)}/month`;
                                }else{
                                    document.getElementById('checkout-submit-btn').innerText = `Pay $${discountedPrice.toFixed(2) - 0.01}/month`;
                                }
                            }

                        } else {
                            // No discount applied, display original price
                            document.getElementById('checkout-submit-btn').innerText = `Pay $${document.getElementById('planPrice').value}/month`;
                        }

                        if (!data.valid) {
                            couponInput.value = '';
                        }
                    } else {
                        // Coupon validation failed, display error message
                        console.error('Coupon validation failed:', data.error);
                        document.getElementById('coupon-errors').innerText = data.message;
                    }
                } catch (error) {
                    // Handle network error
                    console.error('Network error:', error);
                    document.getElementById('coupon-errors').innerText = 'Network error. Please try again.';
                } finally {
                    // Re-enable the coupon input field after validation is complete
                    couponInput.disabled = false;
                }
            }, doneTypingInterval);
        }
    </script>



@endsection
