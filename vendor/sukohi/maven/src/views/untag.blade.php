@extends('app')

@section('content')

<div class="container text-center">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading"> <!-- This div has the orange color for the VNA-->
					<h4>FAQ</h4>
				</div>
				<br />
				<div class="panel-body">
					<img src="{{ asset('img/brandmark_main.png') }}" class="img-responsive center-block" alt="VNA logo">
				</div>
				<br />
				<div id="FAQ">


					<!-- HTML for SEARCH BAR  -->
					<div id="tfheader">
						<form name="tstingForm" id="tfnewsearch" method="post" action="{{ url('/faq/search') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}"> 
							<input type="text" id="tfq" class="tftextinput2" name="keyword" value="{{ $keyword }}" autocomplete="off" size="21" maxlength="120" placeholder="Search FAQs"><input type="submit" value=">>" class="tfbutton2">
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
</div>
@endsection
