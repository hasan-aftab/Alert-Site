@extends('frontend.layout.homepagenew')

@section('content')

            <h1 style="text-align:center">ABOUT US</h1>

<!-- ========== Start about-us-section ========== -->
<section class="about-section" style="margin-bottom: 20px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 d-flex align-items-center">
                <div class="text-right">
                   {!! $page->description !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ========== End about-us-section ========== -->




<!-- ========== Start section-2 about ========== -->



@endsection
