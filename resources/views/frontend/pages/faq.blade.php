@extends('frontend.layout.homepagenew')

@section('content')

<section class="main-section full-container">
    <div class="container flex l-gap flex-mobile lr-m">
        @includeIf('frontend.layout.sidebar')
        <div class="page-content pg-l">
            <h1 class="page-title">FAQ <span class="sm-ls">s</span>
            </h1>
            <div>
                    {!! $page->description !!}
            </div><br>
            <div class="accordion-app">
                @foreach($faq as $q)
                    <button class="accordion">
                        <div class="t-label">{!! $q->title !!}</div>
                    </button>
                    <div class="panel" style="display: none;">{!! $q->description !!}</div>
                @endforeach
            </div>
        </div>
    </div>
</section>

@includeIf('frontend.layout.hero-section')

@endsection
