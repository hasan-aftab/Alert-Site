@extends('frontend.layout.homepagenew')
@section('content')
    <section class="main-section full-container">
        <div class="container flex l-gap flex-mobile lr-m">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            @includeIf('frontend.layout.dashboardsidebar')
            <div class="page-content home">
                <h1 class="page-title">Profile</h1>
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

                        .form-control-input {
                            position: relative;
                        }

                        .form-control-input i {
                            position: absolute;
                            right: 10px;
                            top: 50%;
                            transform: translateY(-50%);
                            cursor: pointer;
                        }
                    </style>

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
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

                    <form name="profile_update" method="post" action="{{ route('profile.update') }}">
                        @csrf
                        
                        <div class="form-control-input">
                            <label>First Name:</label>
                            <input type="text" class="l-operator form-control" placeholder="Enter First Name" id="first_name" name="first_name" value="{{ auth()->user()->first_name }}">
                        </div>

                        <div class="form-control-input">
                            <label>Last Name:</label>
                            <input type="text" class="l-operator form-control" placeholder="Enter Last Name" id="last_name" name="last_name" value="{{ auth()->user()->last_name }}">
                        </div>

                        <div class="form-control-input">
                            <label>Email:</label>
                            <input type="text" class="l-operator form-control" placeholder="Enter Email" id="email" name="email" value="{{ auth()->user()->email }}">
                        </div>

                        <div class="form-control-input">
                            <label>Phone:</label>
                            <input type="text" class="l-operator form-control" placeholder="Enter Phone Number" id="phone_number" name="phone_number" value="{{ auth()->user()->phone_number }}">
                        </div>

                        <div class="form-control-input">
                            <label>New Password:</label>
                            <input autocomplete="new-password" type="password" class="l-operator form-control" placeholder="Enter new password" id="password" name="password" value="">
                            <i class="fa fa-eye" id="togglePasswordIcon" onclick="togglePassword('password')"></i>
                        </div>

                        <div class="form-control-input">
                            <label>Conf. Password:</label>
                            <input autocomplete="new-password" type="password" class="l-operator form-control" placeholder="Confirm new password" id="password_confirmation" name="password_confirmation" value="">
                            <i class="fa fa-eye" id="togglePasswordConfirmIcon" onclick="togglePassword('password_confirmation')"></i>
                        </div>

                        <div class="form-control-add">
                            <input type="submit" id="submit" class="l-submit" value="Update">
                        </div>
                    </form>                   
                </div>
            </div>
        </div>
    </section>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const icon = fieldId === 'password' ? document.getElementById('togglePasswordIcon') : document.getElementById('togglePasswordConfirmIcon');
            
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    @includeIf('frontend.layout.hero-section')

@endsection
