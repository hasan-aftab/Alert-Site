<div class="cta-sidebar">
    <div>
        <p><span class="tagline">TrackRak &amp;<br>Get More<br>Money Back!</span><br>
            <br>
            Stay on top of <a style='color: #8529cd; width:auto; font-weight: 600; text-decoration: none;'
                              href="http://tinyurl.com/d98frkfy" target="_blank">Rakuten</a> deals with our
            alert tool. Never miss out on savings again!<br>
            <br>
            Your first alert is <strong>FREE!</strong></p>
            @if(!auth()->check())<a href="{{route('register')}}" class="cta-btn">Join now!</a>@else <a href="{{ auth()->check() ? route('logout') : route('login') }}" class="cta-btn">Logout</a>@endif
    </div>
    <div>
        @if(!auth()->check())<p>Already saving with TrackRak?</p>
        <a href="{{ route('login') }}" class="cta-btn">
            @if(auth()->guest())
                Login now!
            @endif
        </a>
        @endif
    </div>
</div>