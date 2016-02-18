@extends('app')

@section('content')
<div class="container-fluid">
    <div class="col-md-8 col-md-offset-2">
       <div class="panel panel-default">
            <div class="panel-heading"> <!-- This div has the orange color for the VNA-->
            <br />
            </div>
            <div class="row">
              <img src="{{ asset('img/brandmark_main.png') }}" />
            </div>
            <div class="row">
            </div>
            <br />
            <div class="row">
                <a class="btn btn-default" href="{{ url('vnas_users/') }}" role="button">My Account</a> 
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
            <a class="btn btn-default" href="http://www.thevnacares.org/donate-to-vna/" role="button">Donate to VNA</a>
            </div>
            <br />
        </div>    
    </div>
</div>

@endsection
