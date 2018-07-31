@extends('vendor.layouts.app')

@section('style')
<style>
.sidenav-active{
	background-color: #E9ECEF;
	border-radius: 18px;
}
.breadcrumb {
    position: absolute !important;
    width: auto !important;
    top: 50% !important;
    left: auto !important;
    right: 15px !important;
    margin: -10px 0 0 0 !important;
    background-color: transparent !important;
    padding: 0 !important;
    font-size: 12px;
} 
</style>
@endsection

@section('content')
<div class="container" style="position: relative; padding: 15px">
	<h1>FAQ</h1>
	<div class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{route('faq')}}">FAQ</a></li>
		<li class="breadcrumb-item"><a href="{{route('faq.category',['faq_category' => $faq_category->id])}}">{{$faq_category->title}}</a></li>
		<li class="breadcrumb-item" aria-current="page" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis; max-width: 200px;">{{$current_faq->question}}</li>
	</div>
</div>

<div class="container">
    <div class="row">
    	<div class="col-md-2">
	    	@foreach($faqs as $faq)
	    		<p class="{{$faq->id == $current_faq->id ? 'sidenav-active' : ''}}" style="height: 82px; overflow: hidden; padding:10px;margin-bottom: 0px" >
	    			<a href="{{route('faq.show',['faq' => $faq->id])}}">
	    				{{$faq->question}}
	    			</a>
	    		</p>
	    	@endforeach
    	</div>
    	<div class="col-md-10">
	    	<h2><strong>{{$current_faq->question}}</strong></h2>
	    	<p>{!! $current_faq->answer !!}</p>
    	</div>
	</div>
</div>
@endsection