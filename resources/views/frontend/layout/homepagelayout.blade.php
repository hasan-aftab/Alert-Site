<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('APP_NAME2')}}</title>
    <!-- stylesheet  -->


    <!--
        <link rel="stylesheet" href="asset/frontend/css/stylesheet.css">
        <link rel="stylesheet" href="asset/frontend/css/responsive.css">
    -->

    <link rel="stylesheet" href="{{url('/')}}/asset/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/')}}/asset/frontend/css/responsive.css">
    <link rel="stylesheet" href="{{url('/')}}/asset/frontend/css/stylesheet.css">
    <link rel="stylesheet" href="{{url('/')}}/asset/frontend/css/final-style.css">
    <link rel="stylesheet" href="{{url('/')}}/asset/frontend/css/final-responsive.css">


    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
          integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- slider cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
          integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
          integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="asset/frontend/images/new-logo.jpg">

    @includeIf('frontend.layout.analytic')
</head>

<body>
<!-- ========== Start top-bar ========== -->

<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="left-side" id="logo-hide">
                    <img onclick="window.location.href = '{{ route('home') }}';"
                         src="{{ url('/asset/frontend/images/new-logo.png') }}" alt="" style="width: 294px;">
                </div>
            </div>
            <div class="col-lg-3 d-flex justify-content-end">
                <div class="left-side">

                    @if (Auth::check())
                        <li>
                            @if(Auth::user()->role==1)
                                <span style="cursor: pointer;" class="add-border"
                                      onclick='location.href ="{{route('my_account')}}";'>
                                        My Account
                                    </span>
                            @else
                                <span style="cursor: pointer;" class="add-border"
                                      onclick='location.href ="{{route('track.list')}}";'>
                                        My Account
                                    </span>
                            @endif
                        </li>
                        <li>
                                <span style="cursor: pointer;" onclick='location.href ="{{route('logout')}}";'>
                                    Logout
                                </span>
                        </li>
                    @else
                        <li>
                                <span style="cursor: pointer;" class="add-border"
                                      onclick='location.href ="{{route('register')}}";'>
                                    sign up
                                </span>
                        </li>

                        <li>
                                <span style="cursor: pointer;" onclick='location.href ="{{route('login')}}";'>
                                    sign in
                                </span>
                        </li>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========== Start header ========== -->
<header class="position-sticky">
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}"> <img src="{{url('/')}}/asset/frontend/images/new-logo.jpg"
                                                              alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('track')}}">Track</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('faq')}}">FAQS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('aboutus')}}">About Us</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('contactus')}}">Contact Us </a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('plans')}}">Plans </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

@yield('content')

<!-- ========== Start footer ========== -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-4">
                <div class="fo-one">
                    <img src="{{url('/')}}/asset/frontend/images/new-logo.png" alt="" style="width: 294px;">
                    <p>
                    </p>
                    <div class="f-icon">
                        <i class="fa-brands fa-facebook-f"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-linkedin-in"></i>
                        <i class="fa-brands fa-vimeo-v"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-4 add-padding ">
                <div class="fo-one">
                    <h3>Links</h3>
                    <ul>
                        <li><a href="{{route('track_order')}}">Home</a></li>
                        <li><a href="{{route('shipping')}}"> Track</a></li>
                        <li><a href="{{route('wishlist')}}">Contact us</a></li>
                        <li><a href="{{route('pricing')}}">Pricing</a></li>
                    </ul>
                </div>

            </div>

            <div class="col-md-12 col-lg-4">
                <div class="fo-one">
                    <h3>Talk To Us</h3>
                    <p class="Got">Got Questions? Call us</p>
                    <h4 class="mobile-number">

                    </h4>
                    <ul>
                        <li class="align">
                            <i class="fa-regular fa-envelope"></i>
                            <span>
                                    </span>
                        </li>
                        <li class="align margin-top">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>
                                </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="copy-right">
            <p>© {{date('Y')}} TrackRak, All Rights Reserved | <a href="{{route('terms')}}">Terms & Conditions</a></p>
            <img src="{{url('/')}}/asset/frontend/images/new-logo.jpg" alt="">
        </div>
    </div>
</footer>
<!-- ========== End footer ========== -->
<!-- js file  -->
<!-- slider cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{url('/')}}/asset/frontend/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<script>
    $(document).ready(function () {
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items: 4,
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayTimeout: 1000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        });
        $('.play').on('click', function () {
            owl.trigger('play.owl.autoplay', [1500])
        })
        $('.stop').on('click', function () {
            owl.trigger('stop.owl.autoplay')
        })

        $('#myCarousel').carousel({
            interval: 3000,
            cycle: true
        });
    })

    const buttons = document.querySelectorAll('.carousel-indicators button');

    function triggerClick() {
        // Find the active button
        const activeButton = document.querySelector('.carousel-indicators button.active');

        if (activeButton) {
            // Find the index of the active button
            const activeIndex = Array.from(buttons).indexOf(activeButton);

            // Calculate the index of the next button
            const nextIndex = (activeIndex + 1) % buttons.length;

            // Trigger click on the next button
            buttons[nextIndex].click();
        }
    }

    // Set interval to trigger click every 3 seconds
    setInterval(triggerClick, 3000);
</script>
</body>

</html>
