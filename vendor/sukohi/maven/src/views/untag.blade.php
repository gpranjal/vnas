@extends('app')

@section('content')

<div class="container">
    <div class="col-md-8 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"> <!-- This div has the orange color for the VNA-->
                <h4>FAQ</h4>
            </div>
            <br />
            <div class="row">
              <img src="{{ asset('img/brandmark_main.png') }}">
            </div>
            <br />
            <div id="FAQ">
                <!-- HTML for SEARCH BAR -->
    <div id="tfheader">
        <form id="tfnewsearch" method="get" action="">
                <input type="text" id="tfq" class="tftextinput2" name="q" size="21" maxlength="120" value="Search FAQ"><input type="submit" value=">" class="tfbutton2">
        </form>
        <div class="tfclear"></div>
    </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th>Order</th>
                     <th><nobr>{{ trans('Questions & Answers') }}</nobr></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $index => $faq)
                        <tr>
                            <td>{!! $faq->sort_number !!}</td>
                            <td>
                                <div class="text-bold">{!! $faq->question !!}</div>
                                <br>
                                {!! $faq->answer !!}
                            </td>
                            <td class="text-center">{!! $faq->draft_flag_icon !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            
            <div class="text-center">
                {!! $faqs->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
