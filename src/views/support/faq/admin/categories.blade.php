@extends('layouts.app')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-11" style="padding-top: 20px; padding-bottom: 20px">
			<h2>FAQ Categories</h2> 
		</div>
		<div class="col-md-1 text-right" style="padding-top: 20px; padding-bottom: 10px">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModal"> Add </button>
		</div>

		<div class="col-md-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Item</th>
						<th>Display</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@forelse($faq_categories as $faq_category)
					<tr>
						<td>	
							<p><a href="{{route('faq.admin.index',[$faq_category])}}">{{$faq_category->title}}</a></p>
						</td>
						<td width="10%">
							<input type="checkbox" name="is_show" disabled {{$faq_category->is_show == 1? 'checked' : ''}}>
						</td>
						<td width="20%">
							<div class="btn-group">
								<button data-toggle="modal" data-target="#editCategoryModal" onclick="updateTitle('{{$faq_category->title}}','{{$faq_category->id}}','{{$faq_category->is_show}}')" type="button" class="btn btn-small btn-primary">Edit</button>
								<button type="button" class="btn btn-small btn-danger" data-toggle="modal" data-target="#deleteCategoryModal" onclick="toggleDeleteModal('{{$faq_category->id}}')">Delete</button>
								{!! Form::open(['route' => ['faq.category.admin.delete', $faq_category->id], 'method' => 'DELETE', 'id' => 'deleteCategoryForm#'.$faq_category->id]) !!}
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

<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
			</div>
			<div class="modal-body">
				{!! Form::open(['route' => ['faq.category.admin.store'], 'method' => 'POST']) !!}
					<div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
						<label>Title :</label> 
						{!! Form::text('title', null ,['class' => 'form-control input-box', 'autocomplete' => 'off','style' => 'margin-bottom: 10px;']) !!}
						@if($errors->has('title'))
							<span class="help-block"> <strong>{{ $errors->first('title') }}</strong></span>
						@endif
					</div>
					<div class="form-group {{ $errors->has('is_show') ? 'has-error' : '' }}">
						<label>
							{!! Form::checkbox('is_show', null, false); !!}
							show
						</label>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary float-right">Create</button>
					</div>
                {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form method="post" action="#" id="editCategoryForm" accept-charset="UTF-8">
					@csrf
					<div class="form-group {{ $errors->has('edit_title') ? 'has-error' : '' }}">
						<label>Title :</label> 
						{!! Form::text('edit_title', old('edit_title') ,['id'=>'edit_title', 'class' => 'form-control input-box', 'autocomplete' => 'off','style' => 'margin-bottom: 10px;']) !!}
						@if($errors->has('edit_title'))
							<span class="help-block"><strong>{{ $errors->first('edit_title') }}</strong></span>
						@endif
					</div>
					<div class="form-group">
						<label>
							{!! Form::checkbox('is_show', null, false, ['id'=>'is_show']); !!}
							show
						</label>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary float-right">Update</button>
					</div>
                </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Are sure want delete this?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-small btn-danger" onclick="deleteCategory()">Delete</button>
			</div>
		</div>
	</div>
</div>


@endsection

@section('script')
<script type="text/javascript">

	var editUrl = "{{route('faq.category.admin.update',['id' => ''])}}";
	var deleteCategoryId = '';

    @if($errors->has('title'))
       	$('#createCategoryModal').modal('show');
    @endif

    @if($errors->has('edit_title'))
       	$('#editCategoryModal').modal('show');
    @endif

    function updateTitle($title, $id, $is_show){
    	$('#edit_title').val($title);
    	$('#editCategoryForm').attr('action', window.editUrl + "/" + $id);
    	if($is_show == '1'){
    		$("#is_show").prop("checked", true);
    	}
		$( ".help-block" ).hide();
    }
    
    function toggleDeleteModal($id){
    	window.deleteCategoryId = $id;
    }

    function deleteCategory(){   
    	event.preventDefault();
    	document.getElementById('deleteCategoryForm#' + window.deleteCategoryId).submit();
    }

</script>
@endsection