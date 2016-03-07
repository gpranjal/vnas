@extends('app')

@section('content')
<div class="container text-center">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">

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
							<th>ID</th>
							<th>Title</th>
							<th>Date</th>
							<th>Time</th>
							<th>Caregiver</th>
							<th>LOV</th>
						</tr>
					</thead>

					<tbody>
						<?php $count = 1 ?>
						@foreach ($Vnas_records as $Vnas_record)
						<tr>
							<td><a name="{{'idLink' . $count}}" href="{{ action( $nextCntl , [$Vnas_record->id]) }}">{{ $Vnas_record->id }}</a></td>
							<td>{{ $Vnas_record->ap_title }}</td>
							<td name="{{'dateText' . $count}}">{{ $Vnas_record->ap_date }}</td>
							<td name="{{'timeText' . $count}}">{{ $Vnas_record->ap_time }}</td>
							<td name="{{'nameText' . $count}}">{{ $Vnas_record->caregiver_fname  }} {{ $Vnas_record->caregiver_lname }}</td>
							<td name="{{'lovText' . $count}}">{{ $Vnas_record->ap_lov }} </td>
						</tr>
						<?php $count=$count+1 ?>
						@endforeach
					</tbody>
				</table>
				@endif
			</div>
		</div>
	</div>
</div>


@stop
