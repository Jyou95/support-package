@extends('vendor.layouts.app')

@section('content')

<div class="container">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('faq')}}">FAQ</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{$faq_category->title}}</li>
		</ol>
	</nav>
</div>

<div class="container">

	<div class="row">

		<div class="col-md-12" style="padding-top: 20px; padding-bottom: 10px">
			<h2>FAQ</h2>
		</div>
		<div class="col-sm-12">
			<h4><strong><p>{{$faq_category->title}}</p></strong></h4>
			@forelse($faqs as $faq)	
			<p><a href="{{route('faq.show',['faq' => $faq->id])}}">{{$faq->question}}</a></p>
			<hr>
			@empty
			<h4 style="padding-top: 10px;">No data display.</h4>
			@endforelse
		</div>
	</div>

</div>
@endsection