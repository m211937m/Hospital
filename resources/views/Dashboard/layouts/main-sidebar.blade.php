<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('Dashboard/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('Dashboard/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							<h4 class="font-weight-semibold mt-3 mb-0">{{Auth::user()->name}}</h4>
							<span class="mb-0 text-muted">{{Auth::user()->email}}</span>
						</div>
						@if (auth('web')->check())
                            @include('Dashboard.layouts.main-sidebar.patient-sidebar-main')
                        @elseif (auth('admin')->check())
                           @include('Dashboard.layouts.main-sidebar.admin-main-sidebar')
                        @elseif (auth('doctor')->check())
                            @include('Dashboard.layouts.main-sidebar.doctor-main-sidbare')
                        @elseif (auth('ray_employee')->check())
                            @include('Dashboard.layouts.main-sidebar.ray-emp;oyee-main-sidbare')
                        @elseif (auth('lab_emp')->check())
                            @include('Dashboard.layouts.main-sidebar.lab-emp-main-sidbare')
                        @endif
					</div>
				</div>

			</div>
		</aside>
<!-- main-sidebar -->
