@extends('app')

@section('content')

<div class="container">
<!-- <img src="{{ asset('img/back_arrow.png') }}" align="left" height="40" width="40"> -->
    <div class="col-md-10 col-md-offset-1" >
        <div class="panel panel-default">
            <div class="panel-heading"> <!-- This div has the orange color for the VNA-->
            <h4>Home</h4>
            </div>
            <div class="panel-body">
                <img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive" alt="VNA logo">
              <br />
            <div class="row">
            </div>
            <br />
            <div class="row">
                <a name="myAccountButton" class="btn btn-default" href="{{ url('vnas_users') }}" role="button">My Account</a>
            </div>
            <br />
            <div class="row">
                <a name="myScheduleButton" class="btn btn-default" href="{{ url('vnas_records') }}" role="button">My Schedule</a>
            </div>
            <br />
            <div class="row">
            <a name="faqButton" class="btn btn-default" role="button" href="{{ url('faq') }}">FAQ</a>
            </div>
            <br />
            <div class="row">
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" target="_blank" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="YWC46TWG6WYNU">
                    <input class="btn btn-default" type="submit" value="Donate to VNA"  border="0" name="submit" alt="Donate to VNA">
                    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>
            <br />
        </div>
        </div>    
    </div>
</div>

@endsection


