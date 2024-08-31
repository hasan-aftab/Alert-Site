@extends('frontend.layout.homepagenew')

@section('content')
    <style>
        .page-title{
            margin-bottom: 14px;
        }
    </style>

    <section class="main-section full-container">
        <div class="container flex l-gap flex-mobile lr-m">
            @includeIf('frontend.layout.sidebar')
            <div class="page-content home">
                
                @if(session('success'))
                    <div id="success-message" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem;">
                        {{ session('success') }}
                    </div>
                    <script>
                        setTimeout(function() {
                            var element = document.getElementById('success-message');
                            element.parentNode.removeChild(element);
                        }, 4000); // Remove after 2 seconds (2000 milliseconds)
                    </script>
                @endif

                {!! $page->description !!}

                <div class="btn-container-submit">
    <input type="submit" onclick="window.location.href='{{ route('register') }}'" id="submit" class="l-submit" value="Join Now">    <input type="submit" onclick="window.location.href='{{ route('login') }}'" id="submit" class="l-submit" value="Login Now">
</div>           
           
<p></p>

                <!--
                <div>   
                    {!! $page->description !!}
                </div>
                -->
            </div>
        </div>
    </section>

    @includeIf('frontend.layout.hero-section')
    
@endsection
