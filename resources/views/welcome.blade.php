@extends('app')
@section('content')
<div class="container-fluid"> 
	<div class="col-md-8 col-md-offset-2">   
	    <div class="panel panel-default">
	    	<div class="panel-heading">
	    	<!-- Adding a back button
	    	<div class="span3 text-left"><button class="btn btn-primary">Back</button></div> -->
            	<h3>
            		Care in Your Home
				</h3>
            </div>
	            <div class="panel-body">
	                <img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive img-thumbnail" alt="Responsive image">
	             </div>

	            <div class="panel-body" align="center">
	            <h3>The Face of Care</h3>
	            	<button class="btn btn-default btn-primary" align="center" type="button" value="Contact Us">Contact Us</button>

 	         		<button class="btn btn-default btn-success" align="center" type="button" value="Donate To VNA">Donate to VNA</button>
	         	</div>
        	</div>
        </div>
	</div>
@endsection