<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VNAS Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <!--<link href="../../public/templates/sb-admin-2/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="<?php echo asset('templates/sb-admin-2/bower_components/bootstrap/dist/css/bootstrap.min.css')?>" type="text/css">

    <!-- MetisMenu CSS -->
    <!--<link href="../../public/templates/sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="<?php echo asset('templates/sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.css')?>" type="text/css">

    <!-- Timeline CSS -->
    <!--<link href="../../public/templates/sb-admin-2/dist/css/timeline.css" rel="stylesheet">-->
    <link rel="stylesheet" href="<?php echo asset('templates/sb-admin-2/dist/css/timeline.css')?>" type="text/css">

    <!-- Custom CSS -->
    <!--<link href="../../public/templates/sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">-->
    <link rel="stylesheet" href="<?php echo asset('templates/sb-admin-2/dist/css/sb-admin-2.css')?>" type="text/css">

    <!-- Morris Charts CSS -->
    <!--<link href="../../public/templates/sb-admin-2/bower_components/morrisjs/morris.css" rel="stylesheet">-->
    <link rel="stylesheet" href="<?php echo asset('templates/sb-admin-2/bower_components/morrisjs/morris.css')?>" type="text/css">

    <!-- Custom Fonts -->
    <!--<link href="../../public/templates/sb-admin-2/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="<?php echo asset('templates/sb-admin-2/bower_components/font-awesome/css/font-awesome.min.css')?>" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        
    <![endif]-->
    
    

</head>

<body>

    <div id="wrapper" valign="top">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">VNAS Admin Panel
            </div>
            
	    	<div class="container-fluid">
				 <div class="navbar-header" style="margin: 0px; padding: 0px;">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
					>
						<span class="sr-only">{{ url('/') }}</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				 </div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a name="homeToolbarLink" href="{{ url('/') }}">Home</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li><a name="loginToolbarLink" href="{{ url('/auth/login') }}">Login</a></li>
							<li><a name="registerToolbarLink" href="{{ url('/auth/register') }}">Register</a></li>
						@else
							<li class="dropdown">
								<a name="userMenuToolbarLink" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu" role="menu">
									<li><a name="EditInformationToolbarLink" href="{{ url( '/personal_edit/'.Auth::user()->id ) }}">Edit Your Information</a></li>
									@if(Auth::user()->role == 'admin')
										<li><a name="manageToolbarLink" href="{{ url('/manage') }}">Manage</a></li>
									@endif
									<li><a name="logoutToolbarLink" href="{{ url('/auth/logout') }}">Logout</a></li>
								</ul>
							</li>
						@endif
					</ul>
				</div>
			</div>

            <div class="navbar-default sidebar">
                <div class="sidebar-nav">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ url('/admin') }}"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="{{ url('/system_etl_stats') }}"><i class="fa fa-wrench fa-fw"></i>ETL Stats Log</a>
                        </li>
                                           
                        <li>
                            <a href="{{ url('/manage_faq') }}"><i class="fa fa-wrench fa-fw"></i>FAQ Management</a>
                        </li>

						<li>
                            <a href="{{ url('/system_config') }}"><i class="fa fa-wrench fa-fw"></i>System Configuration Settings</a>
                        </li>
						
                        <li>
                            <a href="{{ url('/manage') }}"><i class="fa fa-wrench fa-fw"></i>User Management</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            @yield('content')
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <!-- I'd like to get the includes on this page, but they don't seem to like to load on time 
	<script src="<?php echo asset('templates/sb-admin-2/bower_components/jquery/dist/jquery.min.js')?>"></script>
	-->
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap Core JavaScript -->
	<script src="<?php echo asset('templates/sb-admin-2/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>



    <!-- Metis Menu Plugin JavaScript -->
	<script src="<?php echo asset('templates/sb-admin-2/bower_components/metisMenu/dist/metisMenu.min.js')?>"></script>



    <!-- Chart data examples  here <script src="<?php echo asset('templates/sb-admin-2/js/morris-data.js')?>"></script>-->
    <!-- Morris Charts JavaScript -->
	<script src="<?php echo asset('templates/sb-admin-2/bower_components/raphael/raphael-min.js')?>"></script>
	<script src="<?php echo asset('templates/sb-admin-2/bower_components/morrisjs/morris.min.js')?>"></script>



    <!-- Custom Theme JavaScript -->
    <script src="<?php echo asset('templates/sb-admin-2/dist/js/sb-admin-2.js')?>"></script>



</body>

</html>

