@extends('app')

@section('content')

            
                <Vnas_record>

                    <div class="container-fluid">
                        <div class="col-md-8 col-md-offset-2">

                           <div class="panel panel-default">

                                <div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
                                    <br />
                                </div>

                                <h1>My Schedule</h1>
                                @if( count($Vnas_records) == 0 )
                                    You don't have any records.  <ol><li>Navigate to vnas_records/create to get started.</li><li>Your registered email account will link to the VNAS Records.</li></ol>
                                @else
                                    <table width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Plan</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($Vnas_records as $Vnas_record)
                                                <tr>
                                                    <td>{{ $Vnas_record->ap_date  }}</td>
                                                    <td>Caregiver: {{ $Vnas_record->caregiver_fname  }} {{ $Vnas_record->caregiver_lname  }}</td>
                                                </tr>

                                                <tr>
                                                    <td>{{ $Vnas_record->ap_time  }}</td>
                                                    <td>LOV: {{ $Vnas_record->ap_lov }} </td>
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
