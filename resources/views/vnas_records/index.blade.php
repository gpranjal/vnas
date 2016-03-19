@extends('app')

@section('content')
<div class="container-fluid text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<div class="panel panel-default">
				<div class="panel-heading"> 
					<h4>My Schedule</h4>
				</div>
				<br />

				<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
				<br />

				@if( count($Vnas_records) == 0 )
				You don't have any records.  <ol><li>Navigate to vnas_records/create to get started.</li><li>Your registered email account will link to the VNAS Records.</li></ol>
				@else
				<table class="table table-hover text-left">
					<thead>
						<tr>
							<th>Title</th>
							<th>Date</th>
							<th>Time</th>
							<th>Caregiver</th>
						</tr>
					</thead>

					<tbody>
						<?php $count = 1 ?>
						@foreach ($Vnas_records as $Vnas_record)
						<tr name="{{'rowLink' . $count}}" class='whole-row-click click_row' data-href='{{ action( $nextCntl , [$Vnas_record->id]) }}'>
							<td name="{{'titleText' . $count}}">{{ $Vnas_record->ap_title }}</td>
							<td name="{{'dateText' . $count}}">{{ $Vnas_record->ap_date->format("m/d/y") }}</td>
							<td name="{{'timeText' . $count}}">
								{{ date( 'H:i' , strtotime( $Vnas_record->ap_date->format("m/d/y") . ' ' . $Vnas_record->ap_time ) ) }}
								-
								{{ date( 'H:i' , strtotime( $Vnas_record->ap_date->format("m/d/y") . ' ' . $Vnas_record->ap_time ) + (60 * (60*$Vnas_record->ap_lov)) ) }}
							</td>
							<td name="{{'nameText' . $count}}">{{ $Vnas_record->caregiver_fname  }} {{ $Vnas_record->caregiver_lname[0] }}</td>
						</tr>
						<?php $count=$count+1 ?>
						@endforeach
					</tbody>
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
				@endif
			</div>
		</div>
	</div>
</div>

<script language="javascript">
	jQuery(document).ready(function($) {
	    $(".whole-row-click").click(function() {
	        window.document.location = $(this).data("href");
	    });
	});
</script>

@stop
