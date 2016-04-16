@extends('app')

@section('content')

<div class="container-fluid text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ol class="breadcrumb">
				<li><a name="HomeToolbarLink" href="{{ url('/') }}">Home</a></li>
				<li><a name="ScheduleToolbarLink" href="{{ url('vnas_records') }}">My Schedule</a></li>
				<li class="active">Details</li>
			</ol>
			<div class="panel panel-default">
				<div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
					<h4>Caregiver Calendar Details</h4>
				</div>
				<br />

				<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
				<br />

				<table class="table table-hover text-left">
					<?php $count = 1 ?>
					@foreach ($Vnas_records as $Vnas_record)
					<tr>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Patient ID:</strong></td>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" name="{{'idText' . $count}}" align="left">{{ $Vnas_record->CLIENT_ID  }}</td>
					</tr>

					<tr>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Patient Name:</strong></td>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" name="{{'nameText' . $count}}" align="left">{{ $Vnas_record->CLIENT_FIRST_NME  }} {{ $Vnas_record->CLIENT_LAST_NME  }}</td>
					</tr>

					<tr>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Address:</strong></td>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="left"><a name="{{'addressText' . $count}}" href="{{ action('MapController@show', [$Vnas_record->CLIENT_ADDRESS]) }}">{{ $Vnas_record->CLIENT_ADDRESS  }}</a>
						</td>
					</tr>

					<tr>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Patient Phone:</strong></td>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" name="{{'PhoneText' . $count}}" align="left">{{ $Vnas_record->CLIENT_PHONE  }}</td>
					</tr>

					<tr>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" align="right"><strong>Comments:</strong></td>
						<td class="col-xs-6 col-sm-6 col-md-6 col-lg-6" name="{{'commentsText' . $count}}" align="left">{{ $Vnas_record->COMMENTS }}</td>
					</tr>
					<?php $count=$count+1 ?>
					@endforeach
				</table>

				<br />
				<div class="row">
						<a class="btn btn-primary btn-lg btn-width-lg" style="width: 118px;" role="button" href="mailto:eschlake@thevnacares.org" name="mailtoButton">
							<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
						</a>
						<a class="btn btn-primary btn-lg btn-width-lg" style="width: 118px;" href="tel:402-930-4240" role="button" name="callButton">
							<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
						</a>
				</div>

			</div>
		</div>
	</div>
</div>


@stop
