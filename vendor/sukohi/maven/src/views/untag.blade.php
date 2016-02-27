@extends('app')

@section('content')

<div class="container-fluid">
    <div class="col-md-8 col-md-offset-2">
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
