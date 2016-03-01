@extends('app')

@section('content')
            
<Vnas_record>

    <div class="container-fluid">
        <div class="col-md-8 col-md-offset-2">

           <div class="panel panel-default">
                <div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
                    <h4>My Schedule</h4>
                </div>
                <br />

                <img src="{{ asset('img/brandmark_main.png') }}">
                <br />


                @if( count($Vnas_records) == 0 )
                    You don't have any records.  <ol><li>Navigate to vnas_records/create to get started.</li><li>Your registered email account will link to the VNAS Records.</li></ol>
                @else
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Schedule ID</th>
                                <th>Patient ID</th>
                                <th>Appointment Title</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Caregiver</th>
                                <th>LOV</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($Vnas_records as $Vnas_record)
                                <tr>
                                    <td><a href="{{ action('VnasRecordsController@sch', [$Vnas_record->id]) }}">{{ $Vnas_record->id }}</a></td>
                                    <td>{{ $Vnas_record->patient_id }}</td>
                                    <td>{{ $Vnas_record->ap_title }}</td>
                                    {{--<td><a href="{{ url('/Vnas_records', $Vnas_record->id) }}">{{ $Vnas_record->ap_title  }}</a></td>--}}
                                    <td>{{ $Vnas_record->ap_date }}</td>
                                    <td>{{ $Vnas_record->ap_time }}</td>
                                    <td>{{ $Vnas_record->caregiver_fname  }} {{ $Vnas_record->caregiver_lname }}</td>
                                    <td>{{ $Vnas_record->ap_lov }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

</Vnas_record>






@stop
