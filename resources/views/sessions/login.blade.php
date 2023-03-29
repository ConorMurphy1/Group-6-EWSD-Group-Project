<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Home</title>
	<link rel="stylesheet" href="{{asset('adminpanel/assets/styles/style.min.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{asset('adminpanel/assets/plugin/waves/waves.min.css')}}">

</head>

<body>

<div id="single-wrapper">
        <form action="{{ route('login') }}" method="POST" class="frm-single">
            @csrf
            <div class="inside">
                <div class="title"><strong>G6-</strong>Admin</div>
                <!-- /.title -->
                <div class="frm-title">Login</div>
                <!-- /.frm-title -->
                <div class="frm-input">
                <input type="email" id="email" name="email"  class="frm-inp" placeholder="Enter your email..." value="{{old('email')}}"><i class="fa fa-user frm-ico"></i>

                </div>
                <!-- /.frm-input -->
                <div class="frm-input">
                <input type="password" id="password" name="password" placeholder="Enter your password..." class="frm-inp"><i class="fa fa-lock frm-ico"></i>

                </div>
                <!-- /.frm-input -->
                <div class="clearfix margin-bottom-20">
                    <div class="pull-left">
                        {{-- <div class="checkbox primary"><input type="checkbox" id="rememberme"><label for="rememberme">Remember me</label></div> --}}
                        <!-- /.checkbox -->
                    </div>
                    <!-- /.pull-left -->
                    {{-- <div class="pull-right"><a href="page-recoverpw.html" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot password?</a></div> --}}
                    <!-- /.pull-right -->
                </div>
                <!-- /.clearfix -->
                <button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
                <!-- /.row -->
                <a href="page-register.html" class="a-link"><i class="fa fa-key"></i>New to G6? Register.</a>
                <div class="frm-footer">G6 © 2023.</div>
                <!-- /.footer -->
            </div>
        </form>
        <!-- /.frm-single -->
    </div><!--/#single-wrapper -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{asset('adminpanel/assets/scripts/jquery.min.js')}}"></script>
        <script src="{{asset('adminpanel/assets/scripts/modernizr.min.js')}}"></script>
        <script src="{{asset('adminpanel/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('adminpanel/assets/plugin/nprogress/nprogress.js')}}"></script>
        <script src="{{asset('adminpanel/assets/plugin/waves/waves.min.js')}}"></script>

        <script src="{{asset('adminpanel/assets/scripts/main.min.js')}}"></script>
    </body>
</html>


