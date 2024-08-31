@extends('frontend.layout.homepagenew')

@section('content')

<section class="main-section full-container">
    <div class="container flex l-gap flex-mobile lr-m">
        @includeIf('frontend.layout.sidebar')
        <div class="page-content pg-l" style="width:700px;">
            <h1 class="page-title">Privacy Policy</h1>
            <div style="">
                {!! $page->description !!}
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.body.style.overflowX = 'hidden';
    });
</script>    

@includeIf('frontend.layout.hero-section')

@endsection


