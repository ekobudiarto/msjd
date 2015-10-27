<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MasjidApps</title>

	<!-- template -->
	<link type="text/css" href="{{ URL::asset('public/css-js/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::asset('public/css-js/bootstrap/css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::asset('public/css-js/css/theme.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ URL::asset('public/css-js/images/icons/css/font-awesome.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.html">
			  		Muslim Daily
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">
				
					<ul class="nav pull-right">
						<?php if(Request::url() == url()."/auth/login"){?>
							<li><a href="{{ url('auth/register') }}">Register</a></li>
							<li><a href="{{ url('password/email') }}">Forgot your password?</a></li>
						<?php } ?>

						<?php if(Request::url() == url()."/auth/register"){?>
							<li><a href="{{ url('auth/login') }}">Login</a></li>
							<li><a href="{{ url('password/email') }}">Forgot your password?</a></li>
						<?php } ?>

						<?php if(Request::url() == url()."/password/email"){?>
							<li><a href="{{ url('auth/login') }}">Login</a></li>
							<li><a href="{{ url('auth/register') }}">Register</a></li>
						<?php } ?>

					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->

	@yield('content')

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2015 MasjidApps </b> All rights reserved.
		</div>
	</div>

	<!-- Scripts -->
	<script src="{{ URL::asset('public/css-js/scripts/jquery-1.9.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('public/css-js/scripts/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('public/css-js/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
</body>
</html>
