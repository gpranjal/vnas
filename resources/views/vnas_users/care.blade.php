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


				@if( count($vnas_users) == 0 )
				You don't have any records.  <ol><li>Navigate to vnas_records/create to get started.</li><li>Your registered email account will link to the VNAS Records.</li></ol>
				@else
				<table class="table table-hover">
					<?php $count = 1 ?>
					@foreach ($vnas_users as $vnas_user)
					<tr>
						<td align="right"><strong>My ID:</strong></td>
						<td align="left" name="{{'idText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->CARE_GIVER_ID  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Name:</strong></td>
						<td align="left" name="{{'nameText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->CARE_GIVER_FIRST_NME  }} {{ $vnas_user->CARE_GIVER_LAST_NME  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Phone:</strong></td>
						<td align="left" name="{{'phoneText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->CARE_GIVER_OFFICE_PH  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Mobile:</strong></td>
						<td align="left" name="{{'emailText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->CARE_GIVER_MOBILE_PH  }}</td>
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
