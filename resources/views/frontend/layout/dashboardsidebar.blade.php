<div class="cta-sidebar">
	<div class="cta-menu-bar">
		
		<a href="{{url('/')}}/dashboard" class="brand-link">
		<span style="font-size: 18px;" class="brand-text font-weight-light">Welcome {{auth()->user()->first_name}} {{auth()->user()->last_name}}</span>
		</a><br><br>

		<ul class="cta-menu">
			<li><a class="{{ Route::currentRouteName() === 'dashboard.index' ? 'nav-active' : '' }}" href="{{route('dashboard.index')}}">Profile</a></li>
			<li><a class="" href="{{route('track')}}">Track</a></li>
			<li><a class="{{ Route::currentRouteName() === 'plans' ? 'nav-active' : '' }}" href="{{route('plans')}}">Edit Plan</a></li>
			@if($currentPlanName=='premium')
				<li style="display:block;"><a class="{{ Route::currentRouteName() === 'myalerts' || Route::currentRouteName() === 'editalert' || Route::currentRouteName() === 'top_deals' ? 'nav-active' : '' }}" href="{{route('top_deals')}}">Top 20 Deals</a></li>
			@endif
			<li><a class="{{ Route::currentRouteName() === 'logout' ? 'nav-active' : '' }}" href="{{route('logout')}}">Logout</a></li>
		</ul>
	</div>
</div>