@extends('app')

@section('content')
            


    <div class="container-fluid">
        <div class="col-md-8 col-md-offset-2">

           <div class="panel panel-default">
                <div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
                    <h4>Schedule details</h4>
                </div>
                <br />

                <img src="{{ asset('img/brandmark_main.png') }}">
                <br />

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Patient Name</th>
                                <th>Patient Address</th>
                                <th>Patient Phone</th>
                                <th>Comments</th>
                            </tr>
                        </thead>

                        <tbody>

                                <tr>
                                    <td>{{ $Vnas_record->patient_id }}</td>
                                    <td>{{ $Vnas_record->patient_fname  }} {{ $Vnas_record->patient_lname  }}</td>
                                    <td>{{ $Vnas_record->patient_address  }}</a></td>
                                    <td>{{ $Vnas_record->patient_phone  }}</td>
                                    <td>{{ $Vnas_record->ap_comments }} </td>
                                </tr>
                        </tbody>

                        <a class="btn btn-default" href="" role="button">Contact us</a>

                        <a class="btn btn-default" href="" role="button">Contact us</a>


                    </table>
               <br />
               <div class="row">
                   <a class="btn btn-default" role="button" href=" {{ HTML::mailto('gpranjal@gmail.com') }}">Email US</a>
               </div>
               <br />
               <div class="row">
                   <a class="btn btn-default" href="" role="button">Contact US</a>
               </div>
               <br />
            </div>
        </div>
    </div>


@stop
