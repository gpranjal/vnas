@extends('app')
@section('content')
<div class="container-fluid" style="border: 1px solid orange">
	<div class="col-md-12">
	    <div class="panel panel-default" style="padding: 0px">
	    	<div class="panel-heading">
	    	<!-- Adding a back button
	    	<div class="span3 text-left"><button class="btn btn-primary">Back</button></div> -->
            	<h3>
					The Face of Care
				</h3>
            </div>
	            <div class="panel-body" align="center">
	                <img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive	" alt="Responsive image">
					<br>
	            	<h4>Serving Omaha, Council Bluffs, and Surrounding Communities</h4>
					<br>


	            	<a name="callButton" class="btn btn-default btn-primary"  href="tel:402-930-4240" role="button" align="center">Contact Us</a>
					<br>


					{{--<a class="btn btn-default" href="tel:402-930-4240" role="button"><img src="{{ asset('img/call.png') }}"></a>--}}

					<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" target="_blank" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="YWC46TWG6WYNU">
						<input class="btn btn-default btn-success" type="submit" value="Donate to VNA"  border="0" name="submit" alt="Donate to VNA">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>

					<br>

 	         		{{--<button class="btn btn-default btn-success" align="center" type="button" value="Donate To VNA">Donate to VNA</button>--}}
	         	</div>
        	</div>
        </div>
	</div>
@endsection
