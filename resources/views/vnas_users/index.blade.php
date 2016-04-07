@extends('app')

@section('content')

<div class="container-fluid text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">

				<div class="panel-heading"> 
					<h4>My Account</h4>
				</div>
				<br />

				<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
				<br />
				<br />

				<div class="panel panel-default"> 
					 <h4><strong>VNAS Online Account Information</strong></h4>
					 <table class="table table-hover">
					 	<tr>
					 		<td align="right"><strong>Name: </strong></td>
					 		<td align="left">{{ $myAppUserInfo->name }}</td>
					 	</tr>
					 	<tr>
					 		<td align="right"><strong>Email: </strong></td>
					 		<td align="left">{{ $myAppUserInfo->email }}</td>
					 	</tr>
					 </table>
				</div>

				@if( count($vnas_users) == 0 )
				You don't have any records.  <ol><li>Navigate to vnas_records/create to get started.</li><li>Your registered email account will link to the VNAS Records.</li></ol>
				@else
				<table class="table table-hover">
					<?php $count = 1 ?>
					@foreach ($vnas_users as $vnas_user)
					<tr>
						<td align="right"><strong>My ID:</strong></td>
						<td align="left" name="{{'idText' . $count}}">{{ $vnas_user->CLIENT_ID  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Name:</strong></td>
						<td align="left" name="{{'nameText' . $count}}">{{ $vnas_user->CLIENT_FIRST_NME  }} {{ $vnas_user->CLIENT_LAST_NME  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Address:</strong></td>
						<td align="left" name="{{'addressText' . $count}}">{{ $vnas_user->CLIENT_ADDRESS  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Mobile Phone:</strong></td>
						<td align="left" name="{{'phoneText' . $count}}">{{ $vnas_user->CLIENT_PHONE  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Email:</strong></td>
						<td align="left" name="{{'emailText' . $count}}">{{ $vnas_user->CLIENT_EMAIL  }}</td>
					</tr>

					<?php $count=$count+1 ?>
					@endforeach
				</table>
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
