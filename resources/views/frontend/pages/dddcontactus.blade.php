@extends('frontend.layout.homepagenew')

@section('content')

    <section class="main-section full-container">
        <div class="container flex l-gap flex-mobile lr-m">
            @includeIf('frontend.layout.sidebar')
            <div class="page-content pg-l">
                <h1 class="page-title">Contact Us</h1>
                <div>
                    {!! $page->description !!}
                </div>

                <style>
                   

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
                </style>

                <div class="page-content">
                <div>
                    @if (count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class = "alert alert-danger">                       
                            <span class="error">{{ session('error') }}</span>
                        </div>
                        <br>
                    @endif

                    @if(session('success'))
                        <div id="success-message" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form name="contact_us_frm" id="contact_us_frm" method="post" action="{{route('contact.save')}}">
                        @csrf
                        
                        <div class="form-control-input">
                            <label>Name:
                            </label>
                            <input type="text" required value="{{old('name')}}" class="l-operator" placeholder="Enter Name" id="name" name="name" style=height: 1.2rem !important; color: black !important;">

                        </div>

                        <div class="form-control-input">
                            <label>Email:
                            </label>
                            <input type="text" required value="{{old('email')}}"  class="l-operator" placeholder="Enter Email" id="email" name="email" style=height: 1.2rem !important; color: black !important;">

                        </div>

                        <div class="form-control-input">
                            <label>Phone:
                            </label>
                            <input type="text" required value="{{old('phone')}}"  class="l-operator" placeholder="Enter Phone" id="phone" name="phone" style=height: 1.2rem !important; color: black !important;">

                        </div>

                        <div class="form-control-input">
                            <label>Message:
                            </label>
                            <textarea cols="8" rows="10" class="l-operator" placeholder="Write your message..." id="message" name="message" style="height: 4.2rem !important; color: black !important;">{{old('message')}}</textarea>
                        </div>                        
                      
                        <div class="form-control-add">
                            <button style="color: #000000;border: 2px solid #000;background-color: #95bb3c;padding: 7px 20px;border-radius: 50px;font-size: 25px;font-weight: bolder;" class="g-recaptcha"
                                    data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"
                                    data-callback="onSubmit"
                                    data-action="submitContact">Submit</button>
                        </div>                       
                    </form>
                </div>
            </div>
            </div>
        </div>
    </section>

@endsection
