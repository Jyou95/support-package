@extends('vendor.layouts.app')

@section('style')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
@endsection

@section('content')

<div class="container">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{route('faq.category.admin.index')}}">FAQ Categories</a></li>
			<li class="breadcrumb-item active" aria-current="page">{{$faq_category->title}}</li>
		</ol>
	</nav>
</div>

<div class="container">

	<div class="row">
		<div class="col-md-12" style="padding-top: 20px; padding-bottom: 10px">
			<h2 style="padding-bottom: 10px">FAQ</h2>
		</div>
		<div class="col-md-11">
			<h4><strong><p>{{$faq_category->title}}</p></strong></h4>
		</div>
		<div class="col-md-1 text-right" style="padding-bottom: 10px">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createQuestionModal"> Add </button>
		</div>
		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Item</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($faqs as $faq)	
					<tr>
						<td>	
							<p> Question : <span id="question#{{$faq->id}}">{{$faq->question}}</span></p>
							<p style="height: 20px; overflow: hidden;"> <span id="answer#{{$faq->id}}">Answer : <a href="{{route('faq.show',['faq' => $faq])}}" target="_blank">View</a></span></p>
						</td>
						<td width="20%">
							<div class="btn-group">
								<a href="{{route('faq.admin.edit',['faq' => $faq, 'faq_category' => $faq_category])}}" type="button" class="btn btn-small btn-primary">Edit</a>
								<button type="button" class="btn btn-small btn-danger" data-toggle="modal" data-target="#deleteQuestionModal" onclick="toggleDeleteModal('{{$faq->id}}')">Delete</button>
								{!! Form::open(['route' => ['faq.admin.delete', $faq_category,  $faq], 'method' => 'DELETE', 'id' => 'deleteQuestionForm#'.$faq->id]) !!}
								{!! Form::close() !!}
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td>
							No data display.
						</td>
						<td></td>
					</tr>
					@endforelse

				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade" id="createQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Question</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => ['faq.admin.create', 'faq_category' => $faq_category->id], 'method' => 'POST']) !!}
				<div class="form-group">
					<label>Question :</label> 
					{!! Form::textarea('question', old('question'), ['id'=>'question', 'class' => 'form-control', 'autocomplete' => 'off', 'rows' => 3]) !!}
					@if($errors->has('question'))
					<span class="help-block"><strong>{{ $errors->first('question') }}</strong></span>
					@endif

				</div>
				<div class="form-group">
					<label>Answer :</label> 	
					{!! Form::textarea('answer', old('answer'), ['id'=>'summernote', 'class' => 'form-control input-box', 'autocomplete' => 'off','style' => 'margin-bottom: 10px;']) !!}
					@if($errors->has('answer'))
					<span class="help-block"><strong>{{ $errors->first('answer') }}</strong></span>
					@endif

				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary float-right">Create</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteQuestionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are sure want delete this question?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-small btn-danger" onclick="deleteQuestion()">Delete</button>
			</div>
		</div>
	</div>
</div>


@endsection

@section('script')

<script type="text/javascript">
	var deleteQuestionId = "";

	@if($errors->has('question') || $errors->has('answer'))
	$('#createQuestionModal').modal('show');
	@endif

	function toggleDeleteModal($id){
		window.deleteQuestionId = $id;
	}

	function deleteQuestion(){   
		event.preventDefault();
		document.getElementById('deleteQuestionForm#' + window.deleteQuestionId).submit();
	}

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$('#summernote').summernote({
		placeholder: '',
		tabsize: 2,
		height: 200
	});
</script>
@endsection