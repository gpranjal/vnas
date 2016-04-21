@extends('admin')

@section('content')
	@if( $myMessage )
		<div class="alert alert-info">
			{{ $myMessage }}
		</div>
	@endif
	
	@if( $myError )
		<div class="alert alert-danger">
			{{ $myError }}
		</div>
	@endif

	@if( $filePresent )
		<br>
		<div class="row">
			<div class="col-md-4 col-md-offset-8">
				<div class="alert alert-success" style="float:right;">
				{{ $filePresent }}
				</div>
			</div>
		</div>
	@endif

	@if( $fileNotPresent )
		<br>
		<div class="row">
			<div class="col-md-4 col-md-offset-8">
				<div class="alert alert-danger" style="float:right;">
					{{ $fileNotPresent }}
				</div>
			</div>
		</div>
	@endif

   {!! $grid !!}
@stop