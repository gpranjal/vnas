@extends('app')

@section('content')
<div class="container-fluid">
    <div class="col-md-8 col-md-offset-2">

       <div class="panel panel-default">

            <div class="panel-heading"> <!-- #00447c is the VNA Logo Color-->
                <br />
            </div>

            <br />

            <div class="row">
                <img src="http://www.thevnacares.org/themes/VNA%20theme%20v2.0/img/brandmark_main.png" alt="VNA">
            </div>
           
            <div class="panel-body">
            <div class="row">
                <a class="btn btn-default" href="http://www.thevnacares.org/" role="button">My Account</a>
            </div>

            <br />

            <div class="row">
                <a class="btn btn-default" href="http://www.thevnacares.org/" role="button">My Schedule</a>
            </div>

            <br />
            <!-- href="{{ url('faq') }}" -->
            <div class="row">
            <a class="btn btn-default" role="button" href="http://localhost:8000/faq">FAQ</a>
            </div>

            <br />

            <div class="row">
                <a class="btn btn-default" href="http://www.thevnacares.org/donate-to-vna/" role="button">Donate to VNA</a>
            </div>
    </div>    
</div>
</div>
</div>
@endsection
