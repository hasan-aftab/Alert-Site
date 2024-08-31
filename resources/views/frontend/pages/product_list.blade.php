@extends('frontend.layout.homepagelayout')

@section('content')
 <!-- ========== Start products section ========== -->
    <section class="products-section">
        <div class="container">
            <div class="text">
                <h4> all products </h4>
            </div>
        </div>
    </section>
    <!-- ========== End products section ========== -->

    
    <section class="Products-3 bg-img">
        <div class="container">                     
            <div class="row">
                
                @php
                   //echo "<pre>"; print_r($products);
                @endphp

                @if($products->count())
                    @foreach($products as $product)
                        @if($product->front_image!="")
                            {{--Product ID: {{$product->id}}--}}
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="img aos-init aos-animate" data-aos="zoom-in">
                                    <img src="{{fileToUrl($product->front_image)}}" alt="">
                                    
                                    @php
                                        $commissionAmount = ($product->commission / 100) * $product->product_price;
                                        $totalPrice = $product->product_price + $commissionAmount;
                                    @endphp

                                    <div class="text-one">
                                        <span>${{number_format($totalPrice,2)}}</span>
                                    </div>
                                    <div class="text-two">
                                        <h4>{{$product->product_name}}</h4>
                                        @php
                                            $url = url('/').'/stand-with-'.strtolower($product->supporting_country).'/shop/'.strtolower($product->product_type).'/'.$product->product_slug;
                                        @endphp
                                        <a class="buy_now" href="{{$url}}"> buy now</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>No Product Found!</p>
                @endif
            </div>
        </div>
    </section>

@endsection