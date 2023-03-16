

<div id="wrapper">
	<div class="main-content">
		<div class="row small-spacing">

			@yield('content')

            @include('sweetalert::alert')
			<!-- /.col-lg-6 col-xs-12 -->
		<!-- /.row -->
		<footer class="footer">
			<ul class="list-inline">
				<li>2023 © G6Admin.</li>
				<li><a href="#">Privacy</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</footer>
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!--
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{asset('adminpanel/assets/scripts/jquery.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/scripts/modernizr.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/nprogress/nprogress.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/waves/waves.min.js')}}"></script>
    <!-- Data Table -->
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.3/af-2.5.2/b-2.3.5/cr-1.6.1/date-1.3.1/fh-3.3.1/r-2.4.0/rr-1.3.2/sp-2.1.1/sr-1.2.1/datatables.min.js"></script>
	<!-- Full Screen Plugin -->
	<script src="{{asset('adminpanel/assets/plugin/fullscreen/jquery.fullscreen-min.js')}}"></script>

	<!-- Percent Circle -->
	<script src="{{asset('adminpanel/assets/plugin/percircle/js/percircle.js')}}"></script>

	<!-- Google Chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<!-- Chartist Chart -->
	<script src="{{asset('adminpanel/assets/plugin/chart/chartist/chartist.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/scripts/chart.chartist.init.min.js')}}"></script>

	<!-- FullCalendar -->
	<script src="{{asset('adminpanel/assets/plugin/moment/moment.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/scripts/fullcalendar.init.js')}}"></script>

	<script src="{{asset('adminpanel/assets/scripts/main.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/color-switcher/color-switcher.min.js')}}"></script>



    @yield('javascript')
</body>
</html>
