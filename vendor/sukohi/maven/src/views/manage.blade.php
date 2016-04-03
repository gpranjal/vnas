@extends('admin')

@section('content')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

@if(!empty($message))
    <br>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {!! $message !!}
    </div>
    @else
    <br>
@endif

<div class="text-right">
        <button id="add_button" class="btn btn-sm btn-success" name="btnAddNewFAQ"><i class="glyphicon glyphicon-plus"></i> {{ trans('Add new FAQ') }}</button>
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
            <img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive" alt="VNA logo">
            <br>
            <br>
            <div class="form-group">
                {!! Form::label(trans('Question')) !!}<br>
                {!! Form::text('question', Request::get('question'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label(trans('Answer')) !!}<br>
                {!! Form::textarea('answer', Request::get('answer'), ['rows' => 7, 'class' => 'form-control']) !!}
            </div>
           <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label(trans('FAQ Role')) !!}<br>
                    {!! Form::text('faq_role', Request::get('faq_role'), ['id' => 'role', 'class' => 'form-control']) !!}                 
                </div>
                <div class="form-group col-md-6">
                    <br>
                    <div>
                    @if(count($role_values) > 0)
                        @foreach($role_values as $role_value)
                            <a href="#" class="label label-info role">{{ $role_value }}</a>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label(trans('Sort')) !!}<br>
                {!! Form::select('sort', $sort_values, Request::get('sort')) !!}
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! Form::label(trans('FAQ Tags')) !!}<br>
                    {!! Form::text('tags', Request::get('tags'), ['id' => 'tags', 'class' => 'form-control', 'name' => 'txtTags']) !!}
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
                {!! link_to(URL::current(), trans('Cancel'), ['class' => 'btn btn-md btn-default', 'name' => 'btnCancel']) !!}&nbsp;
                {!! Form::button(trans('Save'), ['type' => 'submit', 'class' => 'btn btn-md btn-primary', 'name' => 'btnSave']) !!}
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
        <table class="table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th><nobr>{{ trans('Questions & Answers') }}</nobr></th>
                    <th><nobr>{{ trans('FAQ Tags') }}</nobr></th>
                    <th><nobr>{{ trans('Role') }}</nobr></th>
                    <th class="text-center"><nobr>{{ trans('Drafts') }}</nobr></th>
                    <th class="text-right">User Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $count = 1; ?>
            @foreach($faqs as $index => $faq)
                <tr>
                    <td>
                        <div name="{{'titleText' . $count}}">{!! $faq->sort_number !!}</div></td>
                    <td>
                        <div class="text-bold" name="{{'faqQuestion' . $count}}">{!! $faq->question !!}</div>
                        <br>
                        <div class="text-bold" name="{{'faqAnswer' . $count}}">{!! $faq->answer !!}
                    </td>
                    <td class="line-height-2" name="{{'faqTags' . $count}}">
                        @foreach($faq->tags as $tag)
                            <span class="label label-default">{{ $tag }}</span>
                        @endforeach
                    </td>
                    <td class="line-height-2">
                    		
                    	{!! $faq->faq_role !!}
						
                    </td>
                    <td class="text-center">{!! $faq->draft_flag_icon !!}</td>
                    <td class="text-right">
                        <nobr>
                        &nbsp;
                        &nbsp;
                        <a href="?id={{ $faq->id }}" class="btn btn-xs btn-default btn-warning" name="{{'btnFaqEdit' . $count}}">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <button href="?id={{ $faq->id }}" class="btn btn-xs btn-default btn-danger remove-button" data-id="{{ $faq->id }}" name="{{'btnFaqRemove' . $count}}">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                        </nobr>
                    </td>
                </tr>
                <?php $count=$count+1 ?>
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

        $('.role').on('click', function(){

            var role = $(this).html();
            var currentRoleString = $('#role').val();
            var currentRole = currentRoleString.split(',');

            if($.inArray(role, currentRole) == -1) {

                var newRoleString = currentRoleString;

                if(currentRoleString != '') {

                	newRoleString += ',';

                }

                newRoleString += role;
                $('#role').val(newRoleString)

            }

            return false;

        });

    });
</script>

@endsection
