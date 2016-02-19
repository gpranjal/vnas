@extends('app')

@section('content')
    
     @foreach ($patient_records as $Vnas_record)

            <Vnas_record>

                <h2>
                    {{ $Vnas_record->ap_title }}
                </h2>

                <div class="body">

                    <b>Date:</b> {{ $Vnas_record->ap_date  }} </br>

                    <b>Time:</b> {{ $Vnas_record->ap_time  }} </br>

                    <b>LOV:</b> {{ $Vnas_record->ap_lov }} </br>

                    <b>Patient ID:</b><a href="{{ action('VnasRecordsController@patientsch', [$Vnas_record->patient_id]) }}">{{ $Vnas_record->patient_id }}</a> </br>

                    <b>Patient Name:</b> {{ $Vnas_record->patient_fname  }} {{ $Vnas_record->patient_lname  }} </br>

                    <b>Caregiver ID:</b><a href="{{ action('VnasRecordsController@patientsch', [$Vnas_record->caregiver_id]) }}">{{ $Vnas_record->caregiver_id }}</a></br>

                    <b>Caregiver Name:</b> {{ $Vnas_record->caregiver_fname  }} {{ $Vnas_record->caregiver_lname  }} </br>

                </div>

             </Vnas_record>

        @endforeach
@stop
