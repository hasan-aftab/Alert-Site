@extends('frontend.layout.homepagelayout')

@section('content')

<!-- ========== Start blog-heading ========== -->
<section class="blog-heading">
    <div class="container">
        <div class="text">
            <h2>Our Blogs</h2>
        </div>
    </div>
</section>
<!-- ========== End blog-heading ========== -->
<!-- ========== Start blog-cards ========== -->
<section class="cards">
    <div class="container">
        <h2 class="heading-style">Updates</h2>
        <div class="row">
            
            @if($blogs)
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6 col-sm-12  col-12">
                        <div class="style-box">
                            <div class="img-box">
                                <img src="{{$blog->feature_image}}" alt="">
                            </div>
                            <div class="text">
                                <h4>{{$blog->title}}</h4>
                                <p>
                                    {!! substr(strip_tags($blog->description), 0, 100) !!}...
                                </p>
                                <a href="{{url('blog')}}/{{$blog->slug}}"> <button class="btn-style"> Read more </button></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

            
        </div>

    </div>

</section>
@endsection