@extends('app')

@section('content')
	
	<div class="container">
	    <div class="col-md-8 col-md-offset-2">
	       <div class="panel panel-default">
				
                    <div class="panel-heading"> 
                       <h4>My Schedule</h4>
                    </div>
                    <br />
               
	             <img src="{{ asset('img/brandmark_main.png') }}">
	             <br />
	             <br />
	            
	            @if( count($vnas_users) == 0 )
	                You don't have any records.  <ol><li>Navigate to vnas_records/create to get started.</li><li>Your registered email account will link to the VNAS Records.</li></ol>
	            @else
		            <table class="table table-hover">
					<?php $count = 1 ?>
		            @foreach ($vnas_users as $vnas_user)
		            	<tr>
		            		<td align="right"><strong>My ID:</strong></td>
		            		<td align="left" name="id">&nbsp;&nbsp;{{ $vnas_user->patient_id  }}</td>
		            	</tr>

		            	<tr>
		            		<td align="right"><strong>Name:</strong></td>
		            		<td align="left" name="{{'nameText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->patient_fname  }} {{ $vnas_user->patient_lname  }}</td>
		            	</tr>

		            	<tr>
		            		<td align="right"><strong>Address:</strong></td>
		            		<td align="left" name="{{'addressText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->patient_address  }}</td>
		            	</tr>

		            	<tr>
		            		<td align="right"><strong>Phone:</strong></td>
		            		<td align="left" name="{{'phoneText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->patient_phone  }}</td>
		            	</tr>

		            	<tr>
		            		<td align="right"><strong>Email:</strong></td>
		            		<td align="left" name="{{'emailText' . $count}}">&nbsp;&nbsp;{{ $vnas_user->patient_email  }}</td>
		            	</td>

                        <?php $count=$count+1 ?>
		        	@endforeach
		        	</table>
		        @endif

			   <br />
			   <div class="row">
				   <a class="btn btn-default" role="button" href="mailto::eschlake@vnacares.org" name="mailtoButton"><img src="{{ asset('img/mail.png') }}"></a>
				   <a class="btn btn-default" href="tel:402-930-4240" role="button" name="callButton"><img src="{{ asset('img/call.png') }}"></a>
			   </div>
			   <br />

		   </div>
	    </div>
	</div>

@stop
