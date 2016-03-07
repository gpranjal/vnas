@extends('app')

@section('content')



<div class="container-fluid text-center">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
                    <h4>Patient Calendar Details</h4>
                </div>
                <br />

                <img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
                <br />

                <table class="table table-hover">
                    <?php $count = 1 ?>
                    @foreach ($Vnas_records as $Vnas_record)

                    <tr>
                        <td align="right"><strong>Schedule Title</strong></td>
                        <td name="{{'titleText' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->ap_title }}</td>
                    </tr>

                    <tr>
                        <td align="right"><strong>Caregiver ID:</strong></td>
                        <td name="{{'caregiverId' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->caregiver_id  }}</td>
                    </tr>

                    <tr>
                        <td align="right"><strong>Caregiver Name:</strong></td>
                        <td name="{{'caregiverName' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->caregiver_fname  }} {{ $Vnas_record->caregiver_lname  }}</td>
                    </tr>


                    <tr>
                        <td align="right"><strong>Caregiver Phone:</strong></td>
                        <td name="{{'caregiverPhone' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->caregiver_phone  }}</td>
                    </tr>

                    <tr>
                        <td align="right"><strong>Caregiver Mobile:</strong></td>
                        <td name="{{'caregiveMobilePhone' . $count}}" align="left">&nbsp;&nbsp;{{ $Vnas_record->caregiver_mob  }}</td>
                    </tr>
                    <?php $count=$count+1 ?>
                    @endforeach

                </table>

                <br />
                <div class="row">
                    <a class="btn btn-default" role="button" href="mailto:eschlake@vnacares.org" name="mailtoButton"><img src="{{ asset('img/mail.png') }}"></a>
                    <a class="btn btn-default" href="tel:402-930-4240" role="button" name="callButton"><img src="{{ asset('img/call.png') }}"></a>
                </div>
            </div>
        </div>
    </div>
</div>


@stop
