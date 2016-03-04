@extends('app')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#display_answer').hide();
    });

    function expandDiv()
    {
        $('#display_answer').slideToggle("slow");
    }
</script>

<div class="container col-md-12">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"> <!-- This div has the orange color for the VNA-->
                <h4>FAQ</h4>
            </div>
            <br />
            <div class="row">
              <img src="{{ asset('img/brandmark_main.png') }}">
            </div>

           <div class="panel panel-body">
            <div id="FAQ">

                <table class="table table-hover table-responsive" style="cursor: default;">
                    <thead>
                        <tr>
                        <th>Order</th>
                         <th><nobr>{{ trans('Questions') }}</nobr></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($faqs as $index => $faq)
                        <tr>
                            <td>{!! $faq->sort_number !!}</td>
                                                 
                            <td>
                            <div id="display_question" class="text-bold" style="cursor: pointer; display: block;" onclick="expandDiv()">{!! $faq->question !!}</div>
                            
                            <div id="display_answer" class="text-bold" style="cursor: pointer; display: none;">
                            {!! $faq->answer !!}</div>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection