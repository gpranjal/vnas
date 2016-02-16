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
    <body>
    <div class="text-right">
        <button id="add_button" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-plus"></i> {{ trans('Add new FAQ') }}</button>
    </div>
    @if(Request::has('remove_id') || (!Request::has('_token') && !Request::has('id')))
        {!! Form::open(['id' => 'save_form', 'style' => 'display:none']) !!}
    @else
        {!! Form::open(['id' => 'save_form']) !!}
    @endif
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title text-bold">{{ trans('New FAQ form') }}</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                {!! Form::label(trans('Question')) !!}<br>
                {!! Form::text('question', Request::get('question'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('Answer')) !!}<br>
                {!! Form::textarea('answer', Request::get('answer'), ['rows' => 7, 'class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('Sort')) !!}<br>
                {!! Form::select('sort', $sort_values, Request::get('sort')) !!}
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label(trans('FAQ Tags')) !!}<br>
                    {!! Form::text('tags', Request::get('tags'), ['id' => 'tags', 'class' => 'form-control']) !!}
                    <br><span class="text-muted">{{ trans('Example: Forget Password') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <br>
                    <div>
                    @if(count($tag_values) > 0)
                        @foreach($tag_values as $tag_value)
                            <a href="#" class="label label-info tags">{{ $tag_value }}</a>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <div class="clearfix form-group checkbox">
                <label>{!! Form::checkbox('draft_flag', '1', Request::get('draft_flag')) !!} {{ trans('Save as draft') }}</label>
            </div>
            <div class="text-center">
                {!! link_to(URL::current(), trans('Cancel'), ['class' => 'btn btn-md btn-default']) !!}&nbsp;
                {!! Form::button(trans('Save'), ['type' => 'submit', 'class' => 'btn btn-md btn-primary']) !!}
            </div>
        </div>
    </div>
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
                    <th><nobr>{{ trans('FAQ Tags') }}</nobr></th>
                    <th class="text-center"><nobr>{{ trans('Drafts') }}</nobr></th>
                    <th class="text-right">User Action</th>
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
                    <td class="line-height-2">
                        @foreach($faq->tags as $tag)
                            <span class="label label-default">{{ $tag }}</span>
                        @endforeach
                    </td>
                    <td class="text-center">{!! $faq->draft_flag_icon !!}</td>
                    <td class="text-right">
                        <nobr>
                        &nbsp;
                        &nbsp;
                        <a href="?id={{ $faq->id }}" class="btn btn-xs btn-default btn-warning">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <button href="?id={{ $faq->id }}" class="btn btn-xs btn-default btn-danger remove-button" data-id="{{ $faq->id }}">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        </nobr>
                    </td>
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

    </body>

<script>
    $(document).ready(function(){

        $('#add_button').on('click', function(){

            $('#save_form').slideToggle('fast');
            $('textarea[name=question]').focus();

        });
        $('.remove-button').on('click', function(){

            if(confirm('Delete this record?')) {

                var id = $(this).data('id');
                $('#remove_id').val(id);
                $('#remove_form').submit();

            }

        });
        $('.tags').on('click', function(){

            var tag = $(this).html();
            var currentTagString = $('#tags').val();
            var currentTags = currentTagString.split(',');

            if($.inArray(tag, currentTags) == -1) {

                var newTagString = currentTagString;

                if(currentTagString != '') {

                    newTagString += ',';

                }

                newTagString += tag;
                $('#tags').val(newTagString)

            }

            return false;

        });

    });
</script>

@endsection
