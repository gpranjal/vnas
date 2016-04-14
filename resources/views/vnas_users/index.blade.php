@extends('app')

@section('content')

<div class="container-fluid text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ol class="breadcrumb">
				<li><a name="HomeToolbarLink" href="{{ url('/') }}">Home</a></li>
				<li class="active">My Account</li>
			</ol>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>My Account</h4>
				</div>
				<br />

				<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
				<br />
				<br />

				<div class="panel panel-default"> 
					 <h3><strong>VNAS Online Account Information</strong></h3>
					 <table class="table table-hover">
					 	<tr>
					 		<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Name: </strong></td>
					 		<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left">{{ $myAppUserInfo->name }}</td>
					 	</tr>
					 	<tr>
					 		<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Email: </strong></td>
					 		<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left">{{ $myAppUserInfo->email }}</td>
					 	</tr>
					 </table>
				</div>

				@if( $myMessage )
				<div class="alert alert-info">
					{{ $myMessage }}
				</div>
				@else
					<!-- VNAS Client info section -->
					@if( count( $vnas_clients_info ) > 0 )
						<div class="panel panel-default"> 
							<h3><strong>Your VNAS Client Account<?php if( count( $vnas_clients_info ) > 1 ){ echo('s'); } ?></strong></h3>
							
							<table class="table table-hover">
								<?php $count = 1 ?>
								@foreach ($vnas_clients_info as $vnas_user)
									
									@if( count( $vnas_clients_info ) > 1 )
										<thead>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" colspan="2" align="center"><h4>Client Account {{ $count }}</h4></td>
										</thead>
									@endif
									
									<tbody>
										<tr>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Client ID:</strong></td>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'idText' . $count}}">{{ $vnas_user->CLIENT_ID  }}</td>
										</tr>
					
										<tr>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Name:</strong></td>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'nameText' . $count}}">{{ $vnas_user->CLIENT_FIRST_NME  }} {{ $vnas_user->CLIENT_LAST_NME  }}</td>
										</tr>
					
										<tr>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Address:</strong></td>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'addressText' . $count}}">{{ $vnas_user->CLIENT_ADDRESS  }}</td>
										</tr>
					
										<tr>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Mobile Phone:</strong></td>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'phoneText' . $count}}">{{ $vnas_user->CLIENT_PHONE  }}</td>
										</tr>
					
										<tr>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Email:</strong></td>
											<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'emailText' . $count}}">{{ $vnas_user->CLIENT_EMAIL  }}</td>
										</tr>
										
										@if( count( $vnas_clients_info ) > 1 )
											<tr>
												<td colspan="10">&nbsp;</td>
											</tr>
										@endif
									</tbody>
			
								<?php $count=$count+1 ?>
								@endforeach
							</table>
						</div>
					@endif
					
					<!-- VNAS Caregiver info section -->
					@if( count( $vnas_caregivers_info ) > 0 )
						<div class="panel panel-default"> 
							<h3><strong>Your VNAS Caregiver Account</strong></h3>
							<table class="table table-hover">
								<?php $count = 1 ?>
								@foreach ($vnas_caregivers_info as $vnas_user)
									<tr>
										<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>My ID:</strong></td>
										<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'idText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->CARE_GIVER_ID  }}</td>
									</tr>
				
									<tr>
										<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Name:</strong></td>
										<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'nameText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->CARE_GIVER_FIRST_NME  }} {{ $vnas_user->CARE_GIVER_LAST_NME  }}</td>
									</tr>
				
									<tr>
										<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Phone:</strong></td>
										<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'phoneText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->CARE_GIVER_OFFICE_PH  }}</td>
									</tr>
				
									<tr>
										<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Mobile:</strong></td>
										<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left" name="{{'emailText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->CARE_GIVER_MOBILE_PH  }}</td>
									</tr>
								<?php $count=$count+1 ?>
								@endforeach
							</table>
						</div>
					@endif
				@endif

				<br />
				<div class="row">
					<a class="btn btn-primary btn-lg btn-width-lg" style="width: 118px;" role="button" href="mailto:eschlake@vnacares.org" name="mailtoButton">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					</a>
					<a class="btn btn-primary btn-lg btn-width-lg" style="width: 118px;" href="tel:402-930-4240" role="button" name="callButton">
						<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
					</a>
				</div>
				<br />

			</div>
		</div>
	</div>
</div>

@stop
