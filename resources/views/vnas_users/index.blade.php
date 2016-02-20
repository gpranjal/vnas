@extends('app')

@section('content')

	<div class="container-fluid">
	    <div class="col-md-10 col-md-offset-1">

	       <div class="panel panel-default">

	            <div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
	            <h4>My Account</h4>
	            </div>
	            <br />
	             <img src="{{ asset('img/brandmark_main.png') }}" height="1000" width="400">
	             <br />
	             <br />
	            
	            @if( count($vnas_users) == 0 )
	                You don't have any records.  <ol><li>Navigate to vnas_records/create to get started.</li><li>Your registered email account will link to the VNAS Records.</li></ol>
	            @else
		            <table class="table table-hover">
		            @foreach ($vnas_users as $vnas_user)
		            	<tr>
		            		<td align="right"><strong>My ID:</strong></td>
		            		<td align="left">&nbsp;&nbsp;{{ $vnas_user->patient_id  }}</td>
		            	</tr>

		            	<tr>
		            		<td align="right"><strong>Name:</strong></td>
		            		<td align="left">&nbsp;&nbsp;{{ $vnas_user->patient_fname  }} {{ $vnas_user->patient_lname  }}</td>
		            	</tr>

		            	<tr>
		            		<td align="right"><strong>Address:</strong></td>
		            		<td align="left">&nbsp;&nbsp;{{ $vnas_user->patient_address  }}</td>
		            	</tr>

		            	<tr>
		            		<td align="right"><strong>Phone:</strong></td>
		            		<td align="left">&nbsp;&nbsp;{{ $vnas_user->patient_phone  }}</td>
		            	</tr>

		            	<tr>
		            		<td align="right"><strong>Email:</strong></td>
		            		<td align="left">&nbsp;&nbsp;{{ $vnas_user->patient_email  }}</td>
		            	</td>

		        	@endforeach
		        	</table>
		        @endif


	        </div>
	    </div>
	</div>

@stop
