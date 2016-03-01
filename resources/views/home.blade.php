@extends('app')

@section('content')
<div class="container-fluid">
<!-- <img src="{{ asset('img/back_arrow.png') }}" align="left" height="40" width="40"> -->
    <div class="col-md-8 col-md-offset-2" >
        <div class="panel panel-default">
            <div class="panel-heading"> <!-- This div has the orange color for the VNA-->
            <h4>Home</h4>
            </div>
            <div class="panel-body">
              <img src="{{ asset('img/brandmark_main.png') }}">
              <br />
            <div class="row">
            </div>
            <br />
            <div class="row">
                <a class="btn btn-default" href="{{ url('vnas_users') }}" role="button">My Account</a>
            </div>
            <br />
            <div class="row">
                <a class="btn btn-default" href="{{ url('vnas_records') }}" role="button">My Schedule</a>
            </div>
            <br />
            <div class="row">
            <a class="btn btn-default" role="button" href="{{ url('faq') }}">FAQ</a>
            </div>
            <br />
            <div class="row">
            {{--<a class="btn btn-default" href="" role="button">Donate</a>--}}
                <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="PR7AKUXCUW3YQ">
                    <input type="image" class="btn btn-default"  role="button" name="submit" alt="Donate" value="Donate">
                    {{--<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">--}}
                    {{--<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">--}}
                </form>

            </div>
            <br />
        </div>
        </div>    
    </div>
</div>

@endsection
