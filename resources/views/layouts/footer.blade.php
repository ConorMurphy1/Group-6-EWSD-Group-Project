

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
	{{-- <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
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

	<!-- Select2 -->
	<script src="{{asset('adminpanel/assets/plugin/select2/js/select2.min.js')}}"></script>

	<!-- Flex Datalist -->
	<script src="{{asset('adminpanel/assets/plugin/flexdatalist/jquery.flexdatalist.min.js')}}"></script>

	<!-- Multi Select -->
	<script src="{{asset('adminpanel/assets/plugin/multiselect/multiselect.min.js')}}"></script>

	<!-- Chartist Chart -->
	<script src="{{asset('adminpanel/assets/plugin/chart/chartist/chartist.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/scripts/chart.chartist.init.min.js')}}"></script>

	<!-- FullCalendar -->
	<script src="{{asset('adminpanel/assets/plugin/moment/moment.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/scripts/fullcalendar.init.js')}}"></script>

	<script src="{{asset('adminpanel/assets/scripts/main.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/color-switcher/color-switcher.min.js')}}"></script> --}}

	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{asset('adminpanel/assets/scripts/jquery.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/scripts/modernizr.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/nprogress/nprogress.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/plugin/waves/waves.min.js')}}"></script>
	<!-- Full Screen Plugin -->
	<script src="{{asset('adminpanel/assets/plugin/fullscreen/jquery.fullscreen-min.js')}}"></script>

	<!-- Flex Datalist -->
	<script src="{{asset('adminpanel/assets/plugin/flexdatalist/jquery.flexdatalist.min.js')}}"></script>

	<!-- Popover -->
	<script src="{{asset('adminpanel/assets/plugin/popover/jquery.popSelect.min.js')}}"></script>

	<!-- Select2 -->
	<script src="{{asset('adminpanel/assets/plugin/select2/js/select2.min.js')}}"></script>

	<!-- Multi Select -->
	<script src="{{asset('adminpanel/assets/plugin/multiselect/multiselect.min.js')}}"></script>

	<!-- Touch Spin -->
	<script src="{{asset('adminpanel/assets/plugin/touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>

	<!-- Timepicker -->
	<script src="{{asset('adminpanel/assets/plugin/timepicker/bootstrap-timepicker.min.js')}}"></script>

	<!-- Colorpicker -->
	<script src="{{asset('adminpanel/assets/plugin/colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>

	<!-- Datepicker -->
	<script src="{{asset('adminpanel/assets/plugin/datepicker/js/bootstrap-datepicker.min.js')}}"></script>

	<!-- Moment -->
	<script src="{{asset('adminpanel/assets/plugin/moment/moment.js')}}"></script>

	<!-- DateRangepicker -->
	<script src="{{asset('adminpanel/assets/plugin/daterangepicker/daterangepicker.js')}}"></script>

	<!-- Maxlength -->
	<script src="{{asset('adminpanel/assets/plugin/maxlength/bootstrap-maxlength.min.js')}}"></script>

	<!-- Demo Scripts -->
	<script src="{{asset('adminpanel/assets/scripts/form.demo.min.js')}}"></script>

	<!-- Remodal -->
	<script src="{{asset('adminpanel/assets/plugin/modal/remodal/remodal.min.js')}}"></script>

	<script src="{{asset('adminpanel/assets/scripts/main.min.js')}}"></script>
	<script src="{{asset('adminpanel/assets/color-switcher/color-switcher.min.js')}}"></script>


    @yield('javascript')
</body>
</html>
