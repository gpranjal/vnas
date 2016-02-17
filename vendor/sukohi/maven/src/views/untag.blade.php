@extends('app')

@section('content')

@if(!empty($message))
    <br>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! $message !!}
    </div>
    @else
    <br>
    @endif

    @if(Request::has('remove_id') || (!Request::has('_token') && !Request::has('id')))
        {!! Form::open(['id' => 'save_form', 'style' => 'display:none']) !!}
    @else
        {!! Form::open(['id' => 'save_form']) !!}
    @endif
    <br>
       @if(Request::has('id'))
        {!! Form::hidden('id', Request::get('id')) !!}
    @endif
    <br>
    {!! Form::close() !!}
    <br>
    <br>
    @if($faqs->count() > 0)
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
        <div class="text-center">
            {!! $faqs->render() !!}
        </div>
    @endif
    {!! Form::open(['id' => 'remove_form']) !!}
        {!! Form::hidden('remove_id', '', ['id' => 'remove_id']) !!}
    {!! Form::close() !!}

@endsection
