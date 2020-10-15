<div class="sidebar" data-active-color="rose" data-background-color="black"
	data-image="{{ url('ui/img/sidebar-1.jpg') }}">
	<!--
        Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
        Tip 2: you can also add an image using data-image tag
        Tip 3: you can change the color of the sidebar with data-background-color="white | black"
    -->
	<div class="logo">
		<a href="#" class="simple-text">
			{{ isset($me) ? $me->name : "" }}
		</a>
	</div>
	<div class="logo logo-mini">
		<a href="#" class="simple-text">
			Ct
		</a>
	</div>
	<div class="sidebar-wrapper">
		<div class="user">
			<div class="photo">
				<img src="{{  url(!empty($me->photo) ? (string) $me->photo :  'ui/img/faces/avatar.jpg') }}" />
			</div>
			<div class="info">
				<a data-toggle="collapse" href="#collapseExample" class="collapsed">

					<b class="caret"></b>
				</a>
				<div class="collapse" id="collapseExample">
					<ul class="nav">
						@if (Auth::guard('admin')->check())
						<li>
							<a href="{{ route('admin_profile') }}">Edit Profile</a>
						</li>
						@else
						<li>
							<a href="{{ URL::to('profile') }}">Edit Profile</a>
						</li>
						@endif

						<li>
							<center>
								@if (Auth::guard('admin')->check())
								{!! Form::open(['method' => 'POST', 'route' => 'admin_logout','style' => ' color:
								#FFFFFF; margin: 10px 15px 0;' ]) !!}
								@else
								{!! Form::open(['method' => 'POST', 'route' => 'logout','style' => ' color: #FFFFFF;
								margin: 10px 15px 0;' ]) !!}
								@endif

								{!! Form::submit("Sign Out", ['class' => 'btn-link','style' => 'color: #FFFFFF;' ]) !!}

								{!! Form::close() !!}
							</center>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<ul class="nav">
			@if (Auth::check())
			<li class="active">
				<a href="{{ route('home') }}">
					<i class="material-icons">dashboard</i>
					<p>Home</p>
				</a>
			</li>
			{{-- myUserMenuEntry --}}
			@endif
			@if (Auth::guard('agent')->check())
			<li class="active">
				<a href="{{ route('home') }}">
					<i class="material-icons">dashboard</i>
					<p>Home</p>
				</a>
			</li>
			{{-- myAgentMenuEntry --}}
			@endif
			@if (Auth::guard('admin')->check())
			<li class="active">
				<a href="{{ route('admin_home') }}">
					<i class="material-icons">dashboard</i>
					<p>Home</p>
				</a>
			</li>

			{{-- myAdminMenuEntry --}}
			@endif
		</ul>
	</div>
</div>


{{-- 
            <li class="active">
                <a href="dashboard.html">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#pagesExamples">
                    <i class="material-icons">image</i>
                    <p>Pages
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesExamples">
                    <ul class="nav">
                        <li>
                            <a href="pages/pricing.html">Pricing</a>
                        </li>
                    </ul>
                </div>
            </li>
 --}}