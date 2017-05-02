<!-- header -->
<header id="header" class="app-header navbar" role="menu">
	<!-- navbar header -->
	<div class="navbar-header bg-dark">
		<button class="pull-right visible-xs dk" ui-toggle="show" target=".navbar-collapse">
			<i class="glyphicon glyphicon-cog"></i>
		</button>
		<button class="pull-right visible-xs" ui-toggle="off-screen" target=".app-aside" ui-scroll="app">
			<i class="glyphicon glyphicon-align-justify"></i>
		</button>
		<!-- brand -->
		<a href="/" class="navbar-brand text-lt block">
			<img src="{{ static_asset('img/logo-white.png') }}" alt="Starlight" class="">
		</a>
		<!-- / brand -->
	</div>
	<!-- / navbar header -->

	<!-- navbar collapse -->
	<div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">

		@include('menu::header-buttons')

		<!-- nabar right -->
		@if (Auth::user())
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
						<span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
							<img src="{{ Auth::user()->getPhotoUrl() }}" alt="{{ Auth::user()->fullname() }}">
							<i class="on md b-white bottom"></i>
						</span>
						<span class="hidden-sm hidden-md">{{ Auth::user()->fullname() }}</span> <b class="caret"></b>
					</a>
					<!-- dropdown -->
					<ul class="dropdown-menu w">
						{{-- <li>
							<a href="{{ Auth::user()->getDetailsUrl() }}">{{ _('Profile') }}</a>
						</li>
						<li class="divider"></li> --}}
						<li>
							<a href="{{ action('Auth\AuthController@getLogout') }}">{{ _('Logout') }}</a>
						</li>
					</ul>
					<!-- / dropdown -->
				</li>
			</ul>
		@endif
		<!-- / navbar right -->
	</div>
	<!-- / navbar collapse -->
</header>
<!-- / header -->
