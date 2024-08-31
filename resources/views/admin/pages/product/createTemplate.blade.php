<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CauseStand</title>
    <!-- stylesheet  -->
    <!--
        <link rel="stylesheet" href="asset/frontend/css/stylesheet.css">
        <link rel="stylesheet" href="asset/frontend/css/responsive.css">
    -->

    <link rel="stylesheet" href="{{ url('/') }}/asset/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/asset/frontend/css/responsive.css">
    <link rel="stylesheet" href="{{ url('/') }}/asset/frontend/css/stylesheet.css">
    <link rel="stylesheet" href="{{ url('/') }}/asset/frontend/css/final-style.css">
    <link rel="stylesheet" href="{{ url('/') }}/asset/frontend/css/final-responsive.css">


    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- slider cdn  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ url('/') }}/asset/frontend/images/new-logo.jpg">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"
        integrity="sha512-CeIsOAsgJnmevfCi2C7Zsyy6bQKi43utIjdA87Q0ZY84oDqnI0uwfM9+bKiIkI75lUeI00WG/+uJzOmuHlesMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <style>
        .loader {
            border-top-color: #3498db;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <!-- ========== Start top-bar ========== -->

    <input type="hidden" value="{{ url('/') }}" id="site_url">
    <div id="data" hidden>{{ $product }}</div>

    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="left-side" id="logo-hide">
                        <img src="{{ url('/') }}/asset/frontend/images/new-logo.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-3 d-flex justify-content-end">
                    <div class="left-side">

                        @if (Auth::check())
                            <li>
                                <span style="cursor: pointer;" class="add-border"
                                    onclick='location.href ="{{ route('my_account') }}";'>
                                    My Account
                                </span>
                            </li>
                            <li>
                                <span style="cursor: pointer;" onclick='location.href ="{{ route('logout') }}";'>
                                    Logout
                                </span>
                            </li>
                        @else
                            <li>
                                <span style="cursor: pointer;" class="add-border"
                                    onclick='location.href ="{{ route('register') }}";'>
                                    sign up
                                </span>
                            </li>

                            <li>
                                <span style="cursor: pointer;" onclick='location.href ="{{ route('login') }}";'>
                                    login
                                </span>
                            </li>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== End top-bar ========== -->
    <!-- ========== Start header ========== -->
    <header class="position-sticky">
        <nav class="navbar navbar-expand-lg ">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}"> <img
                        src="{{ url('/') }}/asset/frontend/images/new-logo.jpg" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('conflicts') }}">Conflicts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('causes') }}">Causes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop2') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('media') }}">Media</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('justice') }}">Justice</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('aboutus') }}">About Us</a>
                        </li>
                        <button class="donate" onclick='location.href ="{{ route('donate_now') }}";'>DONATE
                            NOW</button>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="crt-prd-main">
        <div class="container">
            <h1 class="product_title">
                {{ $product->website_product_name ? $product->website_product_name : $product->product_name }} (For {{ $product->supporting_country}}) </h1>           
            
                <a href="{{url('/admin/products')}}">Back To Admin</a>
            <br>

            <div class="flex flex-wrap">
                <div class="prd-left">
                    {{-- <div class="flex flex-wrap prd-crs-img">
                        <button class="hover:bg-slate-200 h-[50px] w-[50px]" onclick="setSelected(1)">
                            <img src="https://files.cdn.printful.com/m/ec1000/medium/onman/front/05_ec1000_onman_front_base_whitebg.png?v=1675420344"
                                class="h-full" alt="" />
                        </button>
                        <button class="hover:bg-slate-200 h-[50px] w-[50px]" onclick="setSelected(2)">
                            <img src="{{ url('/') }}/poster.jpg" class="h-full" alt="" />
                        </button>
                        <button class="hover:bg-slate-200 h-[50px] w-[50px]" onclick="setSelected(3)">
                            <img src="{{ url('/') }}/signage.jpg" class="h-full" alt="" />
                        </button>
                    </div> --}}
                    <div class="prd-image">
                        <div style="position: relative" id="canvasParent">
                            <div class="cmn-frame" style="height: 500px; width: 500px; position: absolute; backgorud"
                                id="canvasBgImage">
                            </div>
                            <div class="cmn-frame" style="height: 500px; width: 500px; position: relative">
                                <div class="border-[1px] border-neutral-300 frame-area"
                                    style="
										position: absolute;
										top: 52%;
										left: 48%;
										/* transform: translate(-43%, -70%); */
										z-index: 10;
									"
                                    id="div_front" hidden>

                                    {{-- <canvas id="canvas_front" width="150" height="200"
                                        style="border: 1px; border-color: black"></canvas> --}}
                                </div>
                                <div class="border-[1px] border-neutral-300 frame-area"
                                    style="
										position: absolute;
										top: 60%;
										left: 48%;
										/* transform: translate(-43%, -70%); */
										z-index: 10;
									"
                                    id="div_back" hidden>
                                    {{-- <canvas id="canvas_back" width="150" height="250"
                                        style="border: 1px; border-color: black"></canvas> --}}
                                </div>
                                <div class="border-[1px] border-neutral-300 frame-area"
                                    style="
										position: absolute;
										top: 60%;
										left: 60%;
										/* transform: translate(-43%, -70%); */
										z-index: 10;
									"
                                    id="div_sleeve_left" hidden>
                                    {{-- <canvas id="canvas_sleeve_left" width="140" height="140"
                                        style="border: 1px; border-color: black"></canvas> --}}
                                </div>
                                <div class="border-[1px] border-neutral-300 frame-area"
                                    style="
										position: absolute;
										top: 60%;
										left: 40%;
										/* transform: translate(-43%, -70%); */
										z-index: 10;
									"
                                    id="div_sleeve_right" hidden>
                                    {{-- <canvas id="canvas_sleeve_right" width="140" height="140"
                                        style="border: 1px; border-color: black"></canvas> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="prd-right">
                    <div class="flex flex-col gap-2" id="editables"></div>
                    <div class="prd-option">
                        <div id="product-thumbnails">
                            <button class="border rounded-lg" onclick="setShowCanvas(`canvas_front`, true)">
                                <img id="thumbnail_front" src="" alt="" class="h-[50px] w-[50px]">
                                {{-- front --}}
                            </button>
                            <button class="border  rounded-lg" onclick="setShowCanvas(`canvas_back`, true)">
                                <img id="thumbnail_back" src="" alt="" class="h-[50px] w-[50px]">
                                {{-- back --}}
                            </button>
                            <button class="border  rounded-lg" onclick="setShowCanvas(`canvas_sleeve_left`, true)">
                                <img id="thumbnail_sleeve_left" src="" alt=""
                                    class="h-[50px] w-[50px]">
                                {{-- sleeve_left --}}
                            </button>
                            <button class="border  rounded-lg" onclick="setShowCanvas(`canvas_sleeve_right`, true)">
                                <img id="thumbnail_sleeve_right" src="" alt=""
                                    class="h-[50px] w-[50px]">
                                {{-- sleeve_right --}}
                            </button>
                        </div>
                        <h3>Set Dimentions</h3>
                        <div>
                            <label for="pos-adjust-top">top</label><input id="pos-adjust-top" type="number"
                                style="width: 50px; height: 50px; border: 1px solid" value="10">
                            <label for="pos-adjust-left">left</label><input id="pos-adjust-left" type="number"
                                style="width: 50px; height: 50px; border: 1px solid" value="10">
                            <label for="pos-adjust-height">height</label><input id="pos-adjust-height" type="number"
                                style="width: 50px; height: 50px; border: 1px solid" value="10">
                            <label for="pos-adjust-width">width</label><input id="pos-adjust-width" type="number"
                                style="width: 50px; height: 50px; border: 1px solid" value="10">

                        </div>
                        <h3>Set Images</h3>
                        <div>

                            <label for="pos-adjust-top">front</label><input id="thumbnail_front_input" type="number"
                                style="width: 50px; height: 50px; border: 1px solid" value="0">
                            <label for="pos-adjust-top">back</label><input id="thumbnail_back_input" type="number"
                                style="width: 50px; height: 50px; border: 1px solid" value="1">
                            <label for="pos-adjust-top">left</label><input id="thumbnail_sleeve_left_input"
                                type="number" style="width: 50px; height: 50px; border: 1px solid" value="2">
                            <label for="pos-adjust-top">right</label><input id="thumbnail_sleeve_right_input"
                                type="number" style="width: 50px; height: 50px; border: 1px solid" value="3">
                        </div>
                        <div id="product-thumbnails-selection">
                            {{-- <button class="border rounded-lg" >
                                <img id="thumbnail_front" src="" alt="" class="h-[50px] w-[50px]">                               
                            </button> --}}

                        </div>

                        <div id="product-colours">
                        </div>

                        <div class="flex flex-wrap prd-opt-one align-items-center cmn-prd-opt">
                            <button class="border prd-btn rounded-lg p-2 px-3" onclick="setShowModal(true)">
                                Add Image
                            </button>
                            <div class="img-add-opt">
                                <input id="image-picker" type="file" accept="image/*" class="w-[200px]"
                                    onchange="onImagePikked()" />
                            </div>
                            <button class="border prd-btn rounded-lg p-2 px-3" onclick="addText()">
                                Add Text
                            </button>


                        </div>
                        <div>
                            <button class="border prd-btn rounded-lg p-2 px-3" onclick="togglePreview()">
                                Preview
                            </button>
                        </div>
                        <div class="prd-opt-two cmn-prd-opt">
                            <button class="border rounded-lg p-2 px-3 place-btn" onclick="placeOrder()">
                                Update Template
                            </button>
                        </div>
                        <div class="prd-opt-three cmn-prd-opt" id="text-controls-additional">
                            <div class="flex flex-wrap gap-2 prd-sze">
                                <h4>T-shirt Size :</h4>
                                <input type="radio" id="X" name="fav_language" value="X" />
                                <label for="X">X</label>
                                <br />
                                <input type="radio" id="M" name="fav_language" value="M" />
                                <label for="M">M</label>
                                <br />
                                <input type="radio" id="L" name="fav_language" value="L" />
                                <label for="L">L</label>
                            </div>
                            <div class="prd-opt-four">
                                <h4>Objects:</h4>
                                <!-- <button
                                                                                                                                                                                                                 class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                                                                                                                                                                                                 onclick="addLine()"
                                                                                                                                                                                                                >
                                                                                                                                                                                                                 Line
                                                                                                                                                                                                                </button>
                                                                                                                                                                                                                <button
                                                                                                                                                                                                                 class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                                                                                                                                                                                                 onclick="addRect()"
                                                                                                                                                                                                                >
                                                                                                                                                                                                                 Rectangle
                                                                                                                                                                                                                </button>
                                                                                                                                                                                                                <button
                                                                                                                                                                                                                 class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                                                                                                                                                                                                 onclick="addCircle()"
                                                                                                                                                                                                                >
                                                                                                                                                                                                                 Circle
                                                                                                                                                                                                                </button>
                                                                                                                                                                                                                <button
                                                                                                                                                                                                                 class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                                                                                                                                                                                                 onclick="addTriangle()"
                                                                                                                                                                                                                >
                                                                                                                                                                                                                 Triangle
                                                                                                                                                                                                                </button> -->
                                <div class="prd-objects flex flex-wrap">
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/1-circle-1.svg`)">
                                        <img src="{{ url('/') }}/objects/1-circle-1.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/1-circle-2.svg`)">
                                        <img src="{{ url('/') }}/objects/1-circle-2.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/1-circle-3.svg`)">
                                        <img src="{{ url('/') }}/objects/1-circle-3.svg" width="50px"
                                            alt="" />
                                    </button>

                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/2-rect-1.svg`)">
                                        <img src="{{ url('/') }}/objects/2-rect-1.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/2-rect-2.svg`)">
                                        <img src="{{ url('/') }}/objects/2-rect-2.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/2-rect-3.svg`)">
                                        <img src="{{ url('/') }}/objects/2-rect-3.svg" width="50px"
                                            alt="" />
                                    </button>

                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/3-triangle-1.svg`)">
                                        <img src="{{ url('/') }}/objects/3-triangle-1.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/3-triangle-2.svg`)">
                                        <img src="{{ url('/') }}/objects/3-triangle-2.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/3-triangle-3.svg`)">
                                        <img src="{{ url('/') }}/objects/3-triangle-3.svg" width="50px"
                                            alt="" />
                                    </button>

                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/5-poly-1.svg`)">
                                        <img src="{{ url('/') }}/objects/5-poly-1.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/5-poly-2.svg`)">
                                        <img src="{{ url('/') }}/objects/5-poly-2.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/5-poly-3.svg`)">
                                        <img src="{{ url('/') }}/objects/5-poly-3.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/6-poly-1.svg`)">
                                        <img src="{{ url('/') }}/objects/6-poly-1.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/6-poly-2.svg`)">
                                        <img src="{{ url('/') }}/objects/6-poly-2.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/6-poly-3.svg`)">
                                        <img src="{{ url('/') }}/objects/6-poly-3.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/7-arrow-1.svg`)">
                                        <img src="{{ url('/') }}/objects/7-arrow-1.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/7-arrow-2.svg`)">
                                        <img src="{{ url('/') }}/objects/7-arrow-2.svg" width="50px"
                                            alt="" />
                                    </button>

                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/7-arrow-3.svg`)">
                                        <img src="{{ url('/') }}/objects/7-arrow-3.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/bookmark-shapes.svg`)">
                                        <img src="{{ url('/') }}/objects/bookmark-shapes.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/circle.svg`)">
                                        <img src="{{ url('/') }}/objects/circle.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/cloud.svg`)">
                                        <img src="{{ url('/') }}/objects/cloud.svg" width="50px"
                                            alt="" />
                                    </button>

                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/cube.svg`)">
                                        <img src="{{ url('/') }}/objects/cube.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/heart.svg`)">
                                        <img src="{{ url('/') }}/objects/heart.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/moon.svg`)">
                                        <img src="{{ url('/') }}/objects/moon.svg" width="50px"
                                            alt="" />
                                    </button>
                                    <button class="border rounded-lg p-2 px-3 hover:bg-slate-200"
                                        onclick="addObjectImage(`{{ url('/') }}/objects/star.svg`)">
                                        <img src="{{ url('/') }}/objects/star.svg" width="50px"
                                            alt="" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="modal" hidden>
        <div class="fixed z-20 overflow-y-auto top-0 w-full left-0">
            <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">
                    &#8203;
                </span>
                <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <label class="font-medium text-gray-800">Image Url</label>
                        <input type="text" id="imgUrl"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3"
                            value="https://cloudfour.com/examples/img-currentsrc/images/kitten-small.png" />
                    </div>
                    <div class="bg-gray-200 px-4 py-3 text-right">
                        <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
                            onclick="setShowModal(false)">
                            Cancel
                        </button>
                        <button type="button" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2"
                            type="submit" onclick="submitImgUrl()">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="payment-modal" hidden>
        <div class="fixed z-10 overflow-y-auto top-0 w-full left-0">
            <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                </div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">
                    &#8203;
                </span>
                <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                    role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <label class="font-bold text-gray-800">Payment Details</label>
                        <br>
                        <br>
                        <div id="subtotal" class="font-medium text-gray-800">Subtotal:</div>
                        <div id="shipping" class="font-medium text-gray-800">Shipping:</div>
                        <div id="total" class="font-bold text-gray-800">Total:</div>
                        <br>
                        <br>
                        <label class="font-medium text-gray-800">Name</label>
                        <input type="text" id="payment-modal-name"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" value="John Smith"
                            placeholder="Full Name" />
                        <label class="font-medium text-gray-800">Email</label>
                        <input type="text" id="payment-modal-email"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" value="john@gmail.com"
                            placeholder="email" />
                        <label class="font-medium text-gray-800">Phone Number</label>
                        <input type="text" id="payment-modal-phone"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" value="7384728374"
                            placeholder="Phone Number" />
                        <label class="font-medium text-gray-800">Address</label>
                        <input type="text" id="payment-modal-address"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3" value="19749 Dearborn St"
                            placeholder="Address" />
                        <label class="font-medium text-gray-800">Card Number</label>
                        <input type="text" id="payment-modal-card"
                            class="w-full outline-none rounded bg-gray-100 p-2 mt-2 mb-3"
                            value="1234567890123456"maxlength="16" placeholder="1234 5678 9012 3456" />
                        <div class="flex gap-6">

                            <div class="flex flex-col">
                                <label class="font-medium text-gray-800">Year</label>
                                <input type="text" id="payment-modal-year"
                                    class="w-[55px] outline-none rounded bg-gray-100 p-2 mt-2 mb-3" value="2025"
                                    type="number" placeholder="2025" maxlength="4" />
                            </div>
                            <div class="flex flex-col">
                                <label class="font-medium text-gray-800">Month</label>
                                <input type="text" id="payment-modal-month"
                                    class="w-[35px] outline-none rounded bg-gray-100 p-2 mt-2 mb-3" value="08"
                                    type="number" placeholder="08" maxlength="2" />
                            </div>

                            <div class="flex flex-col">
                                <label class="font-medium text-gray-800">CVC</label>
                                <input type="text" id="payment-modal-cvc"
                                    class="w-[45px] outline-none rounded bg-gray-100 p-2 mt-2 mb-3" value="123"
                                    type="number" placeholder="123" maxlength="3" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-200 px-4 py-3 text-right">
                        <button type="button" class="py-2 px-4 bg-gray-500 text-white rounded hover:bg-gray-700 mr-2"
                            onclick="setShowPaymentModal(false)">
                            Cancel
                        </button>
                        <button type="button" class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-700 mr-2"
                            type="submit" onclick="submitPayment()">
                            Update Template
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- SPINNER -->
    <div id="loader" hidden style="display: none" wire:loading
        class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
        <h2 class="text-center text-white text-xl font-semibold">Loading...</h2>
        <p class="w-1/3 text-center text-white">This may take a few seconds, please don't close this page.</p>
    </div>

    <!-- ========== Start footer ========== -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-3">
                    <div class="fo-one">
                        <img src="{{ url('/') }}/asset/frontend/images/logo-footer.png" alt="">
                        <p>Demonstrate your voice, challenge deception, and advocate for accountability.
                        </p>
                        <div class="f-icon">
                            <i class="fa-brands fa-facebook-f"></i>
                            <i class="fa-brands fa-twitter"></i>
                            <i class="fa-brands fa-linkedin-in"></i>
                            <i class="fa-brands fa-vimeo-v"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-3 add-padding ">
                    <div class="fo-one">
                        <h3>My Account</h3>
                        <ul>
                            <li><a href="{{ route('track_order') }}">Track Orders</a></li>
                            <li><a href="{{ route('shipping') }}"> Shipping</a></li>
                            <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                            <li><a href="{{ route('my_account') }}">My Account</a></li>
                            <li><a href="{{ route('order_history') }}">Order History</a></li>
                            <li><a href="{{ route('return_order') }}">Returns</a></li>
                        </ul>
                    </div>

                </div>



                <div class="col-md-12 col-lg-3 add-padding-two ">
                    <div class="fo-one">
                        <h3>Infomation</h3>
                        <ul>
                            <li><a href="{{ route('products') }}">Products
                                </a></li>
                            <li><a href="{{ route('events') }}">Events</a></li>
                            <li><a href="{{ route('conflicts') }}">Conflicts</a></li>
                            <li><a href="{{ route('aboutus') }}">About Us</a></li>
                            <li><a href="{{ route('contactus') }}">Contact Us </a></li>
                            <li><a href="{{ route('media') }}"> Media</a></li>
                            <li><a href="{{ route('justice') }}"> Justice</a></li>
                            <li><a href="{{ route('blogs') }}"> Blog</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3 ">
                    <div class="fo-one">
                        <h3>Talk To Us</h3>
                        <p class="Got">Got Questions? Call us</p>
                        <h4 class="mobile-number">
                            + 00 123 456 789
                        </h4>
                        <ul>
                            <li class="align">
                                <i class="fa-regular fa-envelope"></i>
                                <span>
                                    info@gmail.com</span>
                            </li>
                            <li class="align margin-top">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>79 Sleepy Hollow St.
                                    Jamaica,
                                </span>
                            </li>
                        </ul>
                    </div>

                </div>




            </div>


            <div class="copy-right">
                <p>© {{ date('Y') }} All Rights Reserved | cause stand.</p>
                <img src="{{ url('/') }}/asset/frontend/images/pay.png" alt="">
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
    <script src="{{ url('/') }}/asset/frontend/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
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
        $('.play').on('click', function() {
            owl.trigger('play.owl.autoplay', [1500])
        })
        $('.stop').on('click', function() {
            owl.trigger('stop.owl.autoplay')
        })
    </script>
    <script src="{{ url('/') }}/product-template-script.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: "#da373d",
                    },
                },
            },
        };
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>
