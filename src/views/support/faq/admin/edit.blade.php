@extends('vendor.layouts.app')

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
		<div class="col-md-12 col-md-offset-3">
		    <h2>Edit Question</h2>

		    {!! Form::open(['route' => ['faq.admin.update','faq' => $faq->id, 'faq_category' => $faq_category->id], 'method' => 'POST']) !!}

		        <div class="form-group">
		            <label>Question :</label> 
					{!! Form::textarea('question', $faq->question, ['id'=>'question', 'class' => 'form-control', 'autocomplete' => 'off', 'rows' => 3]) !!}
					@if($errors->has('question'))
						<span class="help-block"><strong>{{ $errors->first('question') }}</strong></span>
					@endif

		        </div>

		        <div class="form-group">
		            <label>Answer :</label> 	
					{!! Form::textarea('answer', $faq->answer, ['id'=>'summernote', 'class' => 'form-control input-box', 'autocomplete' => 'off','style' => 'margin-bottom: 10px;']) !!}
					@if($errors->has('answer'))
						<span class="help-block"><strong>{{ $errors->first('answer') }}</strong></span>
					@endif

		        </div>

		        <div class="form-group float-right">
		        	<button type="submit" class="btn btn-success ">Update</button>
		        </div>

		    {!! Form::close() !!}
		</div>
	</div>
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$('#summernote').summernote({
		placeholder: '',
		tabsize: 2,
		height: 300
	});
</script>
@endsection