@php
	$user = auth()->user();
@endphp

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Home - G6 University Admin</title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/styles/style.min.css')}}">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/waves/waves.min.css')}}">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/sweet-alert/sweetalert.css')}}">

	<!-- Bootstrap Icon -->
	<link rel="stylesheet" href="{{asset('node_modules/bootstrap-icons/font/bootstrap-icons.css')}}">

	<!-- Percent Circle -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/percircle/css/percircle.css')}}">

	<!-- Chartist Chart -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/chart/chartist/chartist.min.css')}}">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/fullcalendar/fullcalendar.min.css')}}">
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/fullcalendar/fullcalendar.print.css')}}" media='print'>

	<!-- Select2 -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/select2/css/select2.min.css')}}">

	<!-- FlexDatalist -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/flexdatalist/jquery.flexdatalist.min.css')}}">

	<!-- Color Picker -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/color-switcher/color-switcher.min.css')}}">

    <!-- Data Table -->
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.3/af-2.5.2/b-2.3.5/cr-1.6.1/date-1.3.1/fh-3.3.1/r-2.4.0/rr-1.3.2/sp-2.1.1/sr-1.2.1/datatables.min.css" rel="stylesheet"/>

	<!-- Remodal -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/modal/remodal/remodal.css')}}">
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/modal/remodal/remodal-default-theme.css')}}">

	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modal-video/2.0.0/css/modal-video.min.css"> -->
</head>
<body>

	<style>
		button{
			background-color: #304ffe!important;
		}

		.custom-button {
			background-color: rgb(229, 77, 77) !important;
		}
		.custom-button:hover {
			background-color: rgb(237, 44, 44) !important;
		}

		.custom-button-green {
			background-color: #64AA64 !important;
		}
		.custom-button-green:hover {
			background-color: #219e21 !important;
		}
	</style>

	<script src="https://cdn.tailwindcss.com"></script>


    @yield('styles')

</head>

<body>

<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo">G6 Uni</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
		<div class="user">
			<a href="#" class="avatar"><img src="http://placehold.it/80x80" alt=""><span class="status online"></span></a>
			<h5 class="name"><a href="{{ route('admin.profile') }}">{{$user->username}}</a></h5>
			<h5 class="position">{{$user->department->name}}</h5>
			<!-- /.name -->
			<div class="control-wrap js__drop_down">
				<i class="fa fa-caret-down js__drop_down_button"></i>
				<div class="control-list">
                    <form action="{{route('logout')}}" method="post" id="logout">
                        @csrf
                        <div class="control-item"><a href="{{route('admin.profile')}}"><i class="fa fa-user"></i> Profile</a></div>
                        <div class="control-item"><a href="javascript:{}" onclick="document.getElementById('logout').submit();" ><i class="fa fa-sign-out"></i> Log out</a></div>
				    </form>
                </div>
				<!-- /.control-list -->
			</div>
			<!-- /.control-wrap -->
		</div>
		<!-- /.user -->
	</header>
	<!-- /.header -->
	<div class="content">
        <div class="navigation">
			<h5 class="title">Navigation</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">

				<li class="current">
					<a class="waves-effect" href="index.html"><i class="menu-icon fa fa-home"></i><span>Dashboard</span></a>
				</li>
				<li class="">
					<a class="waves-effect" href="{{ route('ideas.feed') }}"><i class="menu-icon fa fa-comments-o" aria-hidden="true"></i><span>Ideas Feed</span></a>
				</li>

				@if (auth()->user()->role->role == 'Admin')
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-adjust"></i><span>RDU Management</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a class="waves-effect" href="{{ route('roles.index') }}"><i class="menu-icon fa fa-users"></i><span>Roles</span></a></li>
						<li><a class="waves-effect" href="{{ route('departments.index') }}"><i class="menu-icon fa fa-university"></i><span>Departments</span></a></li>
                        <li><a class="waves-effect" href="{{ route('admin.users.index') }}"><i class="menu-icon fa fa-user-plus"></i><span>Users</span></a></li>
					</ul>
				</li>
				@endif

				@if (auth()->user()->role->role == 'QA Manager')
				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-exclamation-triangle"></i><span>Reports Management</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li>
							<a class="waves-effect" href="{{ route('admin.reports.ideas') }}"><i class="menu-icon  fa fa-lightbulb-o" aria-hidden="true"></i></i><span>Reported Ideas</span></a>
						</li>
						<li>
							<a class="waves-effect" href="{{ route('admin.reports.comments') }}"><i class="menu-icon fa fa-comment-o" aria-hidden="true"></i></i><span>Reported Comments</span></a>
						</li>
					</ul>
				</li>
				@endif


			</ul>
			<!-- /.menu js__accordion -->
			<h5 class="title">Components</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">

				{{-- <li>
					<a class="waves-effect" href=""><i class="menu-icon fa fa-calendar"></i><span>Calendar</span></a>
				</li> --}}
				<li>
					<a class="waves-effect" href="{{route('events.index')}}"><i class="menu-icon fa fa-calendar"></i><span>Events</span></a>
				</li>

				@if (auth()->user()->role->role == 'Admin')
				<li>
					<a class="waves-effect" href="{{route('ideas.index')}}"><i class="menu-icon fa fa-lightbulb-o"></i><span>Ideas</span></a>
				</li>
				<li>
					<a class="waves-effect" href="{{route('comments.index')}}"><i class="menu-icon fa fa-comment-o"></i><span>Comments</span></a>
				</li>
				@endif

				@if (auth()->user()->role->role == 'QA Manager')
				<li>
					<a class="waves-effect" href="{{route('categories.index')}}"><i class="menu-icon fa fa-list"></i><span>Category</span></a>
				</li>
				@endif
			</ul>
			<!-- /.menu js__accordion -->
			<h5 class="title">Additions</h5>
			<!-- /.title -->
			<ul class="menu js__accordion">
				<li>
					<a class="waves-effect" href="{{ route('admin.profile') }}"><i class="menu-icon fa fa-user"></i><span>Profile</span></a>
				</li>

				<li>
					<a class="waves-effect" href="{{ route('stats.index') }}"><i class="menu-icon fa fa-bar-chart"></i><span>Stats</span></a>
				</li>

				<li>
					<a class="waves-effect" href="{{ route('export-csv') }}"><i class="menu-icon fa fa-download"></i><span>Dowload zip</span></a>
				</li>


			</ul>
			<!-- /.menu js__accordion -->
		</div>
		<!-- /.navigation -->
	</div>
	<!-- /.content -->
</div>
<!-- /.main-menu -->
