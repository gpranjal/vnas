@extends('app')

@section('content')

<div class="container-fluid text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<div class="panel panel-default">
				<div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
					<h4>Caregiver Calendar Details</h4>
				</div>
				<br />

				<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
				<br />

				<table class="table table-hover">
					<?php $count = 1 ?>
					@foreach ($Vnas_records as $Vnas_record)
					<tr>
						<td align="right"><strong>Patient ID:</strong></td>
						<td name="{{'idText' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->patient_id  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Patient Name:</strong></td>
						<td name="{{'nameText' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->patient_fname  }} {{ $Vnas_record->patient_lname  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Address:</strong></td>
						<td align="left">
							&nbsp;&nbsp;<a name="{{'addressText' . $count}}" href="{{ action('MapController@show', [$Vnas_record->patient_address]) }}">{{ $Vnas_record->patient_address  }}</a>
						</td>
					</tr>

					<tr>
						<td align="right"><strong>Patient Phone:</strong></td>
						<td name="{{'PhoneText' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->patient_phone  }}</td>
					</tr>

					<tr>
						<td align="right"><strong>Comments:</strong></td>
						<td name="{{'commentsText' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->ap_comments }}</td>
					</tr>
					<?php $count=$count+1 ?>
					@endforeach
				</table>

				<br />
				<div class="row">
					<a class="btn btn-default" role="button" href="mailto:eschlake@vnacares.org" name="mailtoButton"><img src="{{ asset('img/mail.png') }}"></a>
					<a class="btn btn-default" href="tel:402-930-4240" role="button" name="callButton"><img src="{{ asset('img/call.png') }}"></a>
				</div>

			</div>
		</div>
	</div>
</div>


@stop
