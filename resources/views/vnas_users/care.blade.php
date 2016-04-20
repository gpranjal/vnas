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
				@endif

				<br>
				<div id="contactDiv" class="bg-info col-md-6 col-md-offset-3" align="center">
					<h3 style="font-family: 'Calibri'; ">Conact VNA</h3>
					<a class="btn btn-primary btn-lg btn-width-lg" style="width: 90px;" role="button" href="mailto:eschlake@thevnacares.org" name="mailtoButton">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					</a>
					<a class="btn btn-primary btn-lg btn-width-lg" style="width: 90px;" href="tel:402-930-4240" role="button" name="callButton">
						<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
