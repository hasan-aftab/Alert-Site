@extends('frontend.layout.homepagenew')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
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

    .Login-form-submit-section {
        margin-top: 13px;
        font-weight: bolder;
        display: flex;
        align-content: center;
        gap: 5px;
    }

    .create-account-hover:hover {
        cursor: pointer;
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

    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
    }

    .field-icon {
        font-size: 1.5rem;
    }
</style>

<section class="main-section full-container">
    <div class="container flex l-gap  flex-mobile">
        @includeIf('frontend.layout.sidebar')
        <div class="page-content pg-l">
            <h1 class="page-title">Login</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('message'))
                    <div class="alert alert-info">
                        {{ session('message') }}
                    </div>
                @endif

                <label for="uname"><b>Email</b></label>
                <input type="text" placeholder="Enter Username" name="email">

                <label for="psw"><b>Password</b></label>
                <div style="position: relative;">
                    <input type="password" placeholder="Enter Password" name="password" id="password">
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></span>
                </div>
                <br><br>
                <input type="submit" id="submit" class="l-submit" value="Login">

                <div class="Login-form-submit-section">
                    <span>Don't have an account yet? <a href="{{ route('register.form') }}">Create Account</a></span>
                </div>
                Forgot your password? <a href="{{ route('password.request') }}">Reset Password</a>
            </form>
        </div>
    </div>
</section>

<script>
    document.querySelector(".toggle-password").addEventListener("click", function() {
        var passwordField = document.getElementById("password");
        var type = passwordField.getAttribute("type") === "password" ? "text" : "password";
        passwordField.setAttribute("type", type);

        // Toggle the eye slash icon
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
    });
</script>

@endsection
