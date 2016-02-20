<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VNA-Visting Nurse Association</title>

	<!-- <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Added the styles from Laravel v_5.2 #Farhan -->

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- <link rel="stylesheet" type="text/css" href="css/custom.css"> -->
    <link rel="stylesheet" href="<?php echo asset('css/custom.css')?>" type="text/css">
    {{-- <link href="{{ elixir('css/custom.css') }}" rel="stylesheet"> --}}



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <style>
        .fa-btn {
            margin-right: 10px;
        }

    </style>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default" style="background-color: #236fa0">
		<div class="container-fluid">
			 <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!-- <a class="navbar-brand" href="#">Laravel</a> -->
			</div> 

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"><font color="#fffff">Home</font></a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}"><font color="#fffff">Login</font></a></li>
						<li><a href="{{ url('/auth/register') }}"><font color="#fffff">Register</font></a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><font color="#fffff">{{ Auth::user()->name }}</font><span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}"><font color="black">Logout</font></a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="row">
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><!--Buffer --></div>
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" style="border-radius: 25px; height: 150px; " align="center">
                @yield('content')
            </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"><!--Buffer --></div>
    </div>


	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
