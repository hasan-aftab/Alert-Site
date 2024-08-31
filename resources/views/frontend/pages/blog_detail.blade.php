@extends('frontend.layout.homepagelayout')

@section('content')
<section class="blog-detail" style="display:none">
    <div class="container">
        <div class="text">
            <h2></h2>
        </div>
    </div>
</section>

<div style="background-image:url('{{$blog->blog_image}}');height:400px;">
</div>

<section class="text-all">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="text-style">
                
                    {!! $blog->description !!}

                </div>

            </div>

        </div>

    </div>
</section>       <!-- ========== Start footer ========== -->
@endsection