<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VNA-Visiting Nurse Association</title>

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



    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">

    	window.onload = function(){ 
						//Get submit button
						var submitbutton = document.getElementById("tfq");
						//Add listener to submit button
						if(submitbutton.addEventListener){
							submitbutton.addEventListener("click", function() {
								if (submitbutton.value == 'Search our website'){//Customize this text string to whatever you want
									submitbutton.value = '';
								}
							});
						}
					}
	
    </script>

    <style>
        .fa-btn {
            margin-right: 10px;
        }
        	#tfheader{
		background-color:#c3dfef;
	}
	#tfnewsearch{
		float:right;
		padding:20px;
	}
	.tftextinput2{
		margin: 0;
		padding: 5px 15px;
		font-family: Arial, Helvetica, sans-serif;
		font-size:14px;
		color:#666;
		border:1px solid #0076a3; border-right:0px;
		border-top-left-radius: 5px 5px;
		border-bottom-left-radius: 5px 5px;
	}
	.tfbutton2 {
		margin: 0;
		padding: 5px 7px;
		font-family: Arial, Helvetica, sans-serif;
		font-size:14px;
		font-weight:bold;
		outline: none;
		cursor: pointer;
		text-align: center;
		text-decoration: none;
		color: #ffffff;
		border: solid 1px #0076a3; border-right:0px;
		background: #0095cd;
		background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
		background: -moz-linear-gradient(top,  #00adee,  #0078a5);
		border-top-right-radius: 5px 5px;
		border-bottom-right-radius: 5px 5px;
	}
	.tfbutton2:hover {
		text-decoration: none;
		background: #007ead;
		background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
		background: -moz-linear-gradient(top,  #0095cc,  #00678e);
	}
	/* Fixes submit button height problem in Firefox */
	.tfbutton2::-moz-focus-inner {
	  border: 0;
	}
	.tfclear{
		clear:both;
	}

    </style>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	 <!-- Define a few view dependent global scope variables here -->
	 <?php
		$view_name = Route::getCurrentRoute()->getPath(); // You can use a var_dump($view_Name) to see the current view
	?>

</head>
<body onload='@if( $view_name == "map" )initialize();@endif'>
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
								<li><a href="{{ url( '/edit/'.Auth::user()->id ) }}"><font color="black">Edit Your Information</font></a></li>
								@if(Auth::user()->role == 'admin')
									<li><a href="{{ url('/manage') }}"><font color="black">Manage</font></a></li>
								@endif
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
