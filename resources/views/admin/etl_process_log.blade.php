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

   {!! $grid !!}
@stop