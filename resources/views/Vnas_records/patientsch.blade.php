@extends('app')

@section('content')



    <div class="container-fluid">
        <div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
                    <a href="{{ url('home') }}"><img src="{{ asset('img/home.png') }}" align="left"></a><h4>Patient Calendar Details</h4>
                </div>
                <br />

                <img src="{{ asset('img/brandmark_main.png') }}">
                <br />

                <table class="table table-hover">
                    @foreach ($Vnas_records as $Vnas_record)

                        <tr>
                            <td align="right"><strong>Schedule Title</strong></td>
                            <td align="left">&nbsp;&nbsp;{{ $Vnas_record->ap_title }}</td>
                        </tr>

                        <tr>
                            <td align="right"><strong>Caregiver ID:</strong></td>
                            <td align="left">&nbsp;&nbsp;{{ $Vnas_record->caregiver_id  }}</td>
                        </tr>

                        <tr>
                            <td align="right"><strong>Caregiver Name:</strong></td>
                            <td align="left">&nbsp;&nbsp;{{ $Vnas_record->caregiver_fname  }} {{ $Vnas_record->caregiver_lname  }}</td>
                        </tr>


                        <tr>
                            <td align="right"><strong>Caregiver Phone:</strong></td>
                            <td align="left">&nbsp;&nbsp;{{ $Vnas_record->caregiver_phone  }}</td>
                        </tr>

                        <tr>
                            <td align="right"><strong>Caregiver Mobile:</strong></td>
                            <td align="left">&nbsp;&nbsp;{{ $Vnas_record->caregiver_mob  }}</td>
                        </tr>

                    @endforeach

                </table>

                <br />
                <div class="row">
                    <a class="btn btn-default" role="button" href="mailto::gpranjal@gmail.com"><img src="{{ asset('img/mail.png') }}"></a>
                    <a class="btn btn-default" href="tel:917-435-3648" role="button"><img src="{{ asset('img/call.png') }}"></a>
                </div>
                <br />
                <div align="left">
                    <a class="btn btn-default" role="button" href="{{ URL::previous() }}"><img src="{{ asset('img/back.png') }}"></a>
                </div>


            </div>
        </div>
    </div>


@stop
