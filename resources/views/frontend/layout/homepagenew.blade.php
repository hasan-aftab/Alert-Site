<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">    
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>
        @if (!empty(@$page->meta_title))
            {{@$page->meta_title}}
        @else
            {{env('APP_NAME2')}}
        @endif
    </title>
    <meta name="keywords" content="{{@$page->meta_keywords}}">
    <meta name="description" content="{{@$page->meta_description}}">

    @yield('meta')

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{ asset('asset/frontend/images/favicon.png') }}" type="image/x-icon">

    {{--Intl Tel Input
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/css/intlTelInput.css">
    --}}

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&amp;display=swap" rel="stylesheet">
    <link id="reset_style" rel="stylesheet" href="{{asset('asset/frontend/test/css/normalize.css')}}?v={{time()}}" />
    <link id="layout_main" rel="stylesheet" href="{{asset('asset/frontend/test/css/style.css')}}?v={{time()}}" />
    <link id="layout_menu" rel="stylesheet" href="{{asset('asset/frontend/test/css/menu.css')}}?v={{time()}}" />
    <link id="mobile_responsive" rel="stylesheet" href="{{asset('asset/frontend/test/css/responsive.css')}}?v={{time()}}" />
    <link id="accordion_layout" rel="stylesheet" href="{{asset('asset/frontend/test/css/accordion.css')}}?v={{time()}}" />

    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("contact_us_frm").submit();
        }
    </script>

    @includeIf('frontend.layout.analytic')

    <style>
        body {
            overflow-x: hidden;
        }
    </style>

</head>

<body>

    <!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a>
    to improve your experience.</p>
<![endif]-->

    <header class="menu-section full-container">
      <div class="container flex f-row flex-m-p nav-flex">
            <div class="logo-con">
            @if(auth()->check())
                <a href="{{ route('track') }}">
            @else
                <a href="{{ route('home') }}">
            @endif
                <img src="{{ asset('asset/frontend/test/images/trackrak-logo.png') }}" class="branding" alt="TrackRak logo" />
            </a>
            </div>
            <div class="menu-con">
                
                <div id="menu_burger" class="menu-burger h-large">
                    <span class="b-layer"></span>
                    <span class="b-layer"></span>
                    <span class="b-layer"></span>
                </div>

                <div class="menu-tag">
                    <ul>
                        <li>
                        <a href="{{ route('track') }}" class="m-hover track{{ Route::currentRouteName() == 'track'  || Route::currentRouteName() == 'editalert' ? ' track-active' : '' }}">
                            Track
                            <div class="ml-con">
                                <div class="m-layout h-mobile">
                                    <div class="m-circle">
                                        <div class="inner-cle-track"></div>
                                    </div>
                                    <div class="m-line"></div>
                                </div>
                            </div>
                        </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}" class="m-hover track{{ Route::currentRouteName() == 'faq' ? ' faqs-active' : '' }}">
                                FAQ<span class="sm-ls-menu">s</span>
                                <div class="ml-con">
                                    <div class="m-layout h-mobile">
                                        <div class="m-circle">
                                            <div class="inner-cle-faqs"></div>
                                        </div>
                                        <div class="m-line"></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contactus') }}" class="m-hover track{{ Route::currentRouteName() == 'contactus' ? ' contact-active' : '' }}">Contact
                                <div class="ml-con">
                                    <div class="m-layout h-mobile">
                                        <div class="m-circle">
                                            <div class="inner-cle-contact"></div>
                                        </div>
                                        <div class="m-line"></div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            @if(auth()->check())
                                @if(Auth::user()->role==1)
                                    <a target="" href="{{ url('admin') }}" class="m-hover login{{ Route::currentRouteName() == 'admin' || Route::currentRouteName() == 'myalerts' ? ' login-active' : '' }}">My Account
                                @else(Auth::user()->role==1)  
                                    <a target="" href="{{ route('dashboard.index') }}" class="m-hover login{{ Route::currentRouteName() == 'dashboard.index' || Route::currentRouteName() == 'myalerts' ? ' login-active' : '' }}">My Account
                                @endif  
                                    <div class="ml-con">
                                        <div class="m-layout h-mobile">
                                            <div class="m-circle">
                                                <div class="inner-cle-login"></div>
                                            </div>
                                            <div class="m-line"></div>
                                        </div>
                                    </div>
                                </a>
                            @else
                            <a href="{{ route('login') }}" class="m-hover login{{ Route::currentRouteName() == 'login' ? ' login-active' : '' }}">SignUp/Login
                                <div class="ml-con">
                                    <div class="m-layout h-mobile">
                                        <div class="m-circle">
                                            <div class="inner-cle-login"></div>
                                        </div>
                                        <div class="m-line"></div>
                                    </div>
                                </div>
                            </a>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="bm_container" class="burger-container h-large h-mobile"></div>
    </header>

    @yield('content')

    <!-- ========== Start footer ========== -->

    <section class="full-container ftr-content">
        <footer class="container b-top">
            <div class="ftr-content flex-m-2">
                <div class="l-cols">
                    <a href="http://tinyurl.com/d98frkfy" class="r-link" target="_blank">
                        <img src="{{ asset('/asset/frontend/test/images/get-rakuten.png') }}" alt="Get Rakuten" /></a>
                </div>
                <div class="r-cols">
                    <div class="menu-ftr">
                        
                        <div>
                            <a class="f-menu" href="{{ route('track') }}">TRACK</a>
                        </div>

                        <div>
                            <a class="f-menu" href="{{ route('faq') }}">FAQ<span class="sm-ls-ftr">s</span></a>
                        </div>
                        
                        <div>
                            <a class="f-menu" href="{{ route('contactus') }}">CONTACT</a>
                        </div>

                        <div>
                            <a class="f-menu" href="{{ route('plans') }}">PLANS</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="ftr-terms"><div class="ftr-info"><div id="ftr_yr"></div>TrackRak, All Rights Reserved | <span style="cursor:pointer;"  onclick="window.location.href = '{{ route('terms') }}';">Terms & Conditions</span> | <span style="cursor:pointer;"   onclick="window.location.href = '{{ route('privacy_policy') }}';">Privacy Policy</span></div></div>
        </footer>
    </section>

    <!-- ========== End footer ========== -->
    <script id="form_fields" type="text/javascript" src="{{ asset('asset/frontend/test/js/script.js') }}?v={{time()}}"></script>
    <script>
        'undefined' === typeof _trfq || (window._trfq = []);
        'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
            'tccl.baseHost': 'secureserver.net'
        }, {
            'ap': 'cpbh-mt'
        }, {
            'server': 'p3plmcpnl499668'
        }, {
            'dcenter': 'p3'
        }, {
            'cp_id': '7410277'
        }, {
            'cp_cache': ''
        }, {
            'cp_cl': '6'
        }) // Monitoring performance to make your website faster. If you want to opt-out, please contact web hosting support.
    </script>
    <script async src="https://www.google.com/recaptcha/api.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/intlTelInput.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        // Function to show loader
        function showLoader() {
            const select = document.getElementById('store');
            const option = document.createElement('option');
            option.textContent = 'Loading...';
            select.appendChild(option);
        }

        // Function to hide loader and show default text
        function hideLoaderAndShowDefault(defaultText) {
            const select = document.getElementById('store');
            // Remove any existing "Loading..." option
            const loadingOption = select.querySelector('option[value=""]');
            if (loadingOption) {
                select.removeChild(loadingOption);
            }

            // Check if "Type store name" option already exists
            let defaultOption = select.querySelector('option[value=""]');
            if (!defaultOption) {
                // Create and append the "Type store name" option
                defaultOption = document.createElement('option');
                defaultOption.value = '';
                select.insertBefore(defaultOption, select.firstChild);
            }
            // Update the text content of the default option
            defaultOption.textContent = defaultText;
            defaultOption.disabled = true;
            defaultOption.selected = true;

            if ($('#current_store_id').length) {
                $('#store').val($('#current_store_id').val()).trigger('change');
            }
        }

        function initializeSelect2() {
            $('#store').select2();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Select2 when the page is loaded
            initializeSelect2();

            // Function to load stores via AJAX
            function loadStores() {
                //showLoader();
                const xhr = new XMLHttpRequest();
                xhr.open('GET', '/get_stores', true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);

                            const select = document.getElementById('store');                
                            // Remove existing options before appending new ones
                            while (select.firstChild) {
                                select.removeChild(select.firstChild);
                            }

                            if (response.stores.length > 0) {
                                const select = document.getElementById('store');
                                const fragment = document.createDocumentFragment();

                                response.stores.forEach(function(store) {
                                    const option = document.createElement('option');
                                    option.value = store.store_id;
                                    option.textContent = store.store_name;
                                    fragment.appendChild(option);
                                });

                                select.appendChild(fragment);
                            }                          

                            // Reinitialize Select2 after data is loaded
                            $('#store').select2();
                            hideLoaderAndShowDefault('Type store name');
                        }
                    }
                };
                xhr.send();
            }

            // Load stores when the page is loaded
            loadStores();
        });

        document.addEventListener('DOMContentLoaded', () => {
            document.body.style.overflowX = 'hidden';
        });
    </script>
    @stack('scripts')
</body>

</html>