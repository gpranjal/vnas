@extends('app')

@section('content')

<div class="container-fluid text-center">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
                    <h4>Client Calendar Details</h4>
                </div>
                <br />

                <img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
                <br />

                <table class="table table-hover text-left">
                    <?php $count = 1 ?>
                    @foreach ($Vnas_records as $Vnas_record)
                    
                    <tr>
                        <td align="right"><strong>Schedule Title:</strong></td>
                        <td name="{{'titleText' . $count}}" align="left">{{ $Vnas_record->calendar_type }}</td>
                    </tr>

                    <tr>
                        <td align="right"><strong>Caregiver ID:</strong></td>
                        <td name="{{'caregiverId' . $count}}" align="left">{{ $Vnas_record->caregiver_id  }}</td>
                    </tr>

                    <tr>
                        <td align="right"><strong>Caregiver Name:</strong></td>
                        <td name="{{'caregiverName' . $count}}" align="left">{{ $Vnas_record->care_giver_first_nme }} {{ $Vnas_record->care_giver_last_nme }}</td>
                    </tr>


                    <tr>
                        <td align="right"><strong>Caregiver Phone:</strong></td>
                        <td name="{{'caregiverPhone' . $count}}" align="left">{{ $Vnas_record->caregiver_phone  }}</td>
                    </tr>

                    <tr>
                        <td align="right"><strong>Caregiver Mobile:</strong></td>
                        <td name="{{'caregiveMobilePhone' . $count}}" align="left">{{ $Vnas_record->caregiver_mob  }}</td>
                    </tr>
                    <?php $count=$count+1 ?>
                    @endforeach

                </table>

            </div>
        </div>
    </div>
    <br>
    <div class="col-md-12" align="center">
        <h4><u><b>Contact VNA</b></u></h4>
        <a class="btn btn-primary btn-lg btn-width-lg" style="width: 118px;" role="button" href="mailto:eschlake@thevnacares.org" name="mailtoButton">
            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
        </a>
        <a class="btn btn-primary btn-lg btn-width-lg" style="width: 118px;" href="tel:402-930-4240" role="button" name="callButton">
            <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
        </a>
    </div>
</div>


@stop
