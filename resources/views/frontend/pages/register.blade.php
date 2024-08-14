@extends('frontend.layout.homepagenew')

@section('content')

    <style>

        .text-danger {
            color: #dc3545; /* Red color for indicating danger */
            font-size: 14px; /* Adjust font size as needed */
            margin: 0 0 5px 0; /* Add spacing between the input field and error message */
            display: block; /* Ensure error message appears on a new line */
        }

        .iti.iti--allow-dropdown {
            width: 100%
        }

        .login-title {
            font-size: 4rem;
        }

        form {
            width: 100%
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 7px;
        }

        button {
            width: 100%;
            margin-top: 10px;
            padding: 12px;
            border-radius: 7px;
            background-color: #d1ddb0;
            color: black;
            font-weight: bold;
            border: none;
        }

        button:disabled {
            background-color: #cccccc; /* Change background color */
            color: #666666; /* Change text color */
            cursor: not-allowed; /* Change cursor style */
        }

        @media screen and (max-width: 300px) {
            span.psw {
                display: block;
                float: none;
            }
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .alert-info {
            color: #0c5460;
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }

    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <section class="main-section full-container">
        <div class="container flex l-gap  flex-mobile">

            @includeIf('frontend.layout.sidebar')

            <div class="page-content pg-l">
                <h1 class="page-title">SIGN UP</h1>
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                                @if (session('fullPhoneNumberError'))
                                     <li>{{ session('fullPhoneNumberError') }}</li>
                                @endif
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label for="first_name"><b>First Name</b></label>
                        <input value="{{ old('first_name') }}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');" type="text" id="first_name" placeholder="Enter First Name" name="first_name">
                    </div>

                    <div>
                        <label for="last_name"><b>Last Name</b></label>
                        <input value="{{ old('last_name') }}" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '');" type="text" id="last_name" placeholder="Enter Last Name" name="last_name">
                    </div>

                    <div>
                        <label for="phone_number" class="mb-2"><b>Phone Number</b></label>
                        <input value="{{ old('phone_number') }}" oninput="this.value = this.value.replace(/[^\d]/g, '');" id="phone_number" type="text" name="phone_number" placeholder="Enter Phone Number">
                    </div>

                    <div>
                        <label for="uname"><b>Email</b></label>
                        <input value="{{ old('email') }}" type="text" placeholder="Enter Email" name="email">
                    </div>

                    <div style="position: relative;">
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="password" id="password">
                        <i class="fa fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 62%; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>

                    <div style="position: relative;">
                        <label for="psw_confirmation"><b>Confirm Password</b></label>
                        <input type="password" placeholder="Enter Confirm Password" name="password_confirmation" id="password_confirmation">
                        <i class="fa fa-eye" id="togglePasswordConfirmation" style="position: absolute; right: 10px; top: 62%; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>

                    <div>
                        <br/>
                        <input type="checkbox" name="agree_terms_and_condition"> By clicking on the Sign Up button below, you agree to our <span style="cursor:pointer;text-decoration: underline;"  onclick="window.location.href = '{{ route('terms') }}';">Terms & Conditions</span> and have read our <span style="cursor:pointer;text-decoration: underline;"   onclick="window.location.href = '{{ route('privacy_policy') }}';">Privacy Policy</span>
                    </div>
                    <br>
                    <input type="submit" id="submit" class="l-submit" value="Sign Up">
                    <br><br>
                    Forgot your password? <a href="{{ route('password.request') }}">Reset Password</a>
                </form>
            </div>

        </div>
    </section>

    <script>
        // Toggle visibility for Password field
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // Toggle the eye icon
            this.classList.toggle('fa-eye-slash');
        });

        // Toggle visibility for Confirm Password field
        const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
        const passwordConfirmation = document.querySelector('#password_confirmation');

        togglePasswordConfirmation.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmation.setAttribute('type', type);
            
            // Toggle the eye icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
