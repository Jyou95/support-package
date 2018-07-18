@extends('layouts.app')

@section('content')

<div class="container">
<nav aria-label="breadcrumb">
	  <ol class="breadcrumb">
	    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
	  </ol>
	</nav>
</div>

<div class="container">

    <div class="row">

    	<div class="col-md-12" style="padding-top: 20px; padding-bottom: 10px">
			<h2>FAQ</h2>
		</div>

		@forelse($faq_categories as $faq_category)	
			@if(!empty($faq_category->faqs->toArray()) && ($faq_category->is_show == 1))
				<div class="col-sm-12 col-md-6" style="margin-bottom: 25px;">
					<h4><strong><p>{{$faq_category->title}}</p></strong></h4>
					@foreach($faq_category->faqs->take(config('faq.faq_limit')) as $faqs)	
						<p>
							<a style="color: black" href="{{route('faq.show',['faq' => $faqs->id])}}">
								{{$faqs->question}}
							</a>
						</p>
						<hr style="margin-right: 50px">
					@endforeach
					@if($faq_category->faqs_count > config('faq.faq_limit'))
						<p><a href="{{route('faq.category',['faq_category' => $faq_category->id])}}" role="button">View more &raquo;</a></p>
					@endif
				</div>
			@endif
		@empty
		<div class="col-sm-12">
			<h3>No data display</h3>
		</div>
		@endforelse
	</div>

</div>
@endsection