@extends('Dashboard.layouts.master')
@section('css')
<!--- Internal Fontawesome css-->
<link href="{{URL::asset('Dashboard/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!---Ionicons css-->
<link href="{{URL::asset('Dashboard/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<!---Internal Typicons css-->
<link href="{{URL::asset('Dashboard/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
<!---Internal Feather css-->
<link href="{{URL::asset('Dashboard/plugins/feather/feather.css')}}" rel="stylesheet">
<!---Internal Falg-icons css-->
<link href="{{URL::asset('Dashboard/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">
@endsection
@section('content')
		<!-- Main-error-wrapper -->
		<div class="main-error-wrapper  page page-h ">
			<img src="{{URL::asset('Dashboard/img/media/404.png')}}" class="error-page" alt="error">
			<h2>Oopps. The page you were looking for doesn't exist.</h2>
			<h6>You may have mistyped the address or the page may have moved.</h6>
                                    @if (auth('web')->check())
                                        <a class="btn btn-outline-danger" href="{{ route('dashboard.user') }}">Back to Home</a>
                                    @elseif (auth('admin')->check())
                                        <a class="btn btn-outline-danger" href="{{ route('dashboard.admin') }}">Back to Home</a>
                                    @elseif (auth('ray_employee')->check())
                                        <a class="btn btn-outline-danger" href="{{ route('dashboard.ray_employee') }}">Back to Home</a>
                                    @elseif (auth('lab_emp')->check())
                                        <a class="btn btn-outline-danger" href="{{ route('dashboard.lab_emp') }}">Back to Home</a>
                                    @elseif (auth('doctor')->check())
                                        <a class="btn btn-outline-danger" href="{{ route('dashboard.doctor') }}">Back to Home</a>
                                    @endif
		</div>
		<!-- /Main-error-wrapper -->


@endsection
@section('js')
@endsection
