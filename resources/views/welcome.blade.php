@extends('app')
@section('content')
<div class="container text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<div class="panel panel-default">
				<div class="panel-heading text-center">
			    	<!-- Adding a back button
			    	<div class="span3 text-left"><button class="btn btn-primary">Back</button></div> -->
			    	<h3>
			    		The Face of Care
			    	</h3>
			    </div>
			</div>
		</div>
		<div class="panel-body text-center" align="center">
			<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
			<br>
			<br>
			<h4>Serving Omaha, Council Bluffs, and Surrounding Communities</h4>
			<br>
			<br>


			<a name="callButton" class="btn btn-default btn-primary"  href="tel:402-930-4240" role="button" align="center">Contact Us</a>
			<br>
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

@endsection
