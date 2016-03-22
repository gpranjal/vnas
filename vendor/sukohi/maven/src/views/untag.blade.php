@extends('app')

@section('content')

<div class="container-fluid text-center">
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
<!-- 					Hidden, not deleted, by the request of the client. -->
<!-- 					<div id="tfheader"> -->
<!-- 						<form name="tstingForm" id="tfnewsearch" method="post" action="{{ url('/faq/search') }}"> -->
<!-- 							<input type="hidden" name="_token" value="{{ csrf_token() }}">  -->
<!-- 							<input type="text" id="tfq" class="tftextinput2" name="keyword" value="{{ $keyword }}" autocomplete="off" size="21" maxlength="120" placeholder="Search FAQs"><input name="SearchSubmit" type="submit" value=">>" class="tfbutton2"> -->
<!-- 						</form> -->
<!-- 						<div class="tfclear"></div> -->
<!-- 					</div> -->

					<table class="table table-hover text-left">
						<tbody>
						<?php $count = 1 ?>
							@foreach($faqs as $index => $faq)
								<tr name="{{'row' . $count}}" myCnt="{{$count}}" class="whole-row-click click_row">
									<td>
										<div name="{{'ques' . $count}}" id="{{'ques' . $count}}">
											<strong>{!! $faq->question !!}</strong>
										</div>
										<div name="{{'ans' . $count}}" id="{{'ans' . $count}}" style="display: none;" class="sub-row-answer">
											{!! $faq->answer !!}
										</div>
									</td>
								</tr>
							<?php $count=$count+1 ?>
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

<script language="javascript">
	jQuery(document).ready(function($) {
		$(".whole-row-click").click(function() {
// 			console.log( $(".sub-row-answer:visible") );
			
			/* Close all open answer divs by class:visible */
			$(".sub-row-answer:visible").slideToggle( "slow", function() {
			// Animation complete.
			});

			/* Open div by clicked and attribute  nbr */
			$( "#ans"+  $( this).attr( "myCnt") ).slideToggle( "slow", function() {
			// Animation complete.
			});
			
		});
	});
</script>


@endsection
