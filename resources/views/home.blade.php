@extends('app')
@section('content')

<div class="container-fluid text-center">
	<!-- <img src="{{ asset('img/back_arrow.png') }}" align="left" height="40" width="40"> -->
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
			<div class="panel panel-default">
				<div class="panel-heading text-center"> <!-- This div has the orange color for the VNA-->
					<h4>Home</h4>
				</div>
				<div class="panel-body text-center">
					<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo" />

					<p style="margin-top: 50px;">
						<a type="button" name="myAccountButton" class="btn btn-primary btn-lg btn-width-lg" style="width: 250px;" href="{{ url('vnas_users') }}">
							<span class="glyphicon glyphicon-th-list" aria-hidden="true" style="padding-right: 10px;"></span>My Account
						</a>
					</p>	

					<p>
						<a name="myScheduleButton" class="btn btn-primary btn-lg btn-width-lg" style="width: 250px;" href="{{ url('vnas_records') }}">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true" style="padding-right: 10px;"></span>My Schedule
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

							<button class="btn btn-primary btn-lg btn-width-lg" style="width: 250px;">
								<span class="glyphicon glyphicon-usd" aria-hidden="true" style="padding-right: 10px;"></span>Donate to VNA
							</button>                            
						</form>
					</p>
					
				</div>    
			</div>
		</div>
	</div>
</div>

@endsection
