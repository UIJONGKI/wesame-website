@extends('layouts.app')

@section('content')
	<div class="sub-gallery-upload-container">
		<h3>
			Gallery Edit
		</h3>
		<hr/>
		<div class="sub-gallery-upload">
			<form action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
				{!! csrf_field() !!}
				{!! method_field('PUT') !!}

				@include('galleries.partial.form')

				<div class="sub-gallery-upload-savebtn">
					<button type="submit" class="btn btn-primary">
						수정하기
					</button>
				</div>
			</form>
		</div>
	</div>
@stop