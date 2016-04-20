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
					<h4>My Schedule</h4>
				</div>
				<br />

				<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
				<br />

				<div id="dateRangeFilterOuter">
					<form name="dateRangeForm" id="dateRangeCheck" action="{{ url('vnas_records/') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<fieldset class="form-group" style="width: 50%; float:none; margin: 0 auto;">
							<label>Select Date Range:</label>
							<!-- <?php echo ($myRole); echo(" -- I am in ".$myRangeValue." view"); ?> -->
							<select name="dateRangeFilterInner" id="dateRangeFilterInner" class="form-control">

								@foreach ($dateRange as $mydateRangeVal)

									<option value="{{ $mydateRangeVal }}" @if( $mydateRangeVal == $myRangeValue ) selected="selected" @endif>{{ $mydateRangeVal }}</option>
								@endforeach

							</select>
						</fieldset>
					</form>
				</div>

				@if( $myMessage )
					<div class="alert alert-info">
						{{ $myMessage }}
					</div>
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
						<?php $count = 1; ?>
						@foreach ($Vnas_records as $Vnas_record)
						<tr name="{{'rowLink' . $count}}" class='whole-row-click click_row' data-href='{{ action( $nextCntl , [$Vnas_record->SCHEDULE_SK] , $myRangeValue ) }}'>
							<td name="{{'titleText' . $count}}">{{ $Vnas_record->CALENDAR_TYPE }}</td>
							<td name="{{'dateText' . $count}}">{{ date_format( $Vnas_record->SCHEDULE_START_DTTM  , 'm/d/y' ) }}</td>
							<td name="{{'timeText' . $count}}">
								{{ date( 'H:i' , strtotime( $Vnas_record->SCHEDULE_START_DTTM ) ) }}
								-
								{{ date( 'H:i' , strtotime( $Vnas_record->SCHEDULE_END_DTTM )  ) }}
							</td>
							<td name="{{'nameText' . $count}}">{{ $Vnas_record->CARE_GIVER_FIRST_NME  }} {{ $Vnas_record->CARE_GIVER_LAST_NME }}</td>
						</tr>
						<?php $count=$count+1 ?>
						@endforeach
					</tbody>
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

<script language="javascript">
	jQuery(document).ready(function($) {
		$(".whole-row-click").click(function() {
			window.document.location = $(this).data("href");
		});

		$('#dateRangeFilterInner').on('change', function(e){
			var select = $(this), form = $("#dateRangeCheck"), currPath = form.attr('action'), newPath = "";

			if( $( select ).val() != "Current")
			{
				newPath = "/filter/All/"+ $( select ).val();
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
