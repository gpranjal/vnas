@extends('app')

@section('content')
<div class="container-fluid text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ol class="breadcrumb">
				<li><a name="HomeToolbarLink" href="{{ url('/') }}">Home</a></li>
				<li class="active">My Schedule</li>
			</ol>
			<div class="panel panel-default">
				<div class="panel-heading"> 
					<h4>My Multi-role Schedule</h4>
				</div>
				<br />

				<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
				<br />

				@if( $myMessage )
					<div class="alert alert-info">
						{{ $myMessage }}
					</div>
				@else
					<div id="tfheader">
						<form name="tstingForm" id="tfnewsearch" action="{{ url('vnas_records/') }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<fieldset class="form-group" style="width: 70%; float:none; margin: 0 auto;">
								<label>Select Role:</label>
								<select name="multiroleFilter" id="multiroleFilter" class="form-control">
									@foreach ($myRoleList as $myRoleVal)
									   <option value="{{ $myRoleVal }}" @if( $myRoleVal == $myRole ) selected="selected" @endif>{{ $myRoleVal }}</option>
									@endforeach
								</select>
							</fieldset>
						</form>
					</div>
					
					<table class="table table-hover text-left">
						<thead>
							<tr>
								<th>Title</th>
								<th>Date</th>
								<th>Time</th>
								<th>Caregiver</th>
								<th>Patient</th>
							</tr>
						</thead>

						<tbody>
							<?php $count = 1; ?>
							@foreach ($Vnas_records as $Vnas_record)

							<tr name="{{'idLink' . $count}}" class='whole-row-click click_row' data-href='{{ action( $nextCntl , [$Vnas_record->SCHEDULE_SK]) }}'>
								<td>{{ $Vnas_record->CALENDAR_TYPE }}</td>
								<td name="{{'dateText' . $count}}">{{ date_format( date_create( $Vnas_record->SCHEDULE_START_DTTM )  , 'm/d/y' ) }}</td>
								<td name="{{'timeText' . $count}}">
									{{ date( 'H:i' , strtotime( $Vnas_record->SCHEDULE_START_DTTM ) ) }}
								-
								{{ date( 'H:i' , strtotime( $Vnas_record->SCHEDULE_END_DTTM )  ) }}
								</td>
								<td name="{{'nameText' . $count}}">{{ $Vnas_record->CARE_GIVER_FIRST_NME }} {{ $Vnas_record->CARE_GIVER_LAST_NME }}</td>
								<td name="{{'nameText' . $count}}">{{ $Vnas_record->CLIENT_FIRST_NME }} {{ $Vnas_record->CLIENT_LAST_NME }}</td>
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
					<br />
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

	   $('#multiroleFilter').on('change', function(e){
		    var select = $(this), form = $("#tfnewsearch"), currPath = form.attr('action'), newPath = "";
		    if( $( select ).val() != "All" )
		    {
		   		newPath = "/role/"  + $( select ).val();
		   		form.attr('action', form.attr('action') + newPath );
		   		form.submit();
		   	}
		   	else
		   	{
		   		window.location.href="{{ url('vnas_records/') }}";
		   	}
		});
	});
</script>

@stop