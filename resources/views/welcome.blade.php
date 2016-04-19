@extends('app')
@section('content')
<div class="container-fluid text-center">
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

				<div class="panel-body text-center" align="center">
					<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
					<br>
					<br>
					<h4>Serving Omaha, Council Bluffs, and Surrounding Communities</h4>
					<br>
					<br>

					<p>
						<a name="myLoginButton" class="btn btn-primary btn-lg btn-width-lg" style="width: 250px;"  href="{{ url('auth/login') }}">
							<span class="glyphicon glyphicon-user" aria-hidden="true" style="padding-right: 10px;"></span>Login
						</a>
					</p>

					<P>
						<a name="faqButton" class="btn btn-primary btn-lg btn-width-lg" style="width: 250px;" href="{{ url('faq') }}">
							<span class="glyphicon glyphicon-question-sign" aria-hidden="true" style="padding-right: 10px;"></span>FAQ
						</a>
					</P>

					<p>
						<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="{{ $donateAPIKey }}">

							<button name="donateButton" class="btn btn-primary btn-lg btn-width-lg" style="width: 250px;">
								<span class="glyphicon glyphicon-usd" aria-hidden="true" style="padding-right: 10px;"></span>Donate to VNA
							</button>                            
						</form>
					</p>

					<p>
						<a class="btn btn-primary btn-lg btn-width-lg" style="width: 118px;" role="button" href="mailto:eschlake@vnacares.org" name="mailtoButton">
							<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
						</a>
						<a class="btn btn-primary btn-lg btn-width-lg" style="width: 118px;" href="tel:402-930-4240" role="button" name="callButton">
							<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
						</a>
					</p>
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
