@extends('layouts.app')

@section('content')
	
	<div class="sub-gallery-upload-container">
		<h3>
			News Upload
		</h3>
		<hr/>
		<div class="sub-gallery-upload">
			<form action="{{ route('articles.store') }}" method="POST" class="form__article" enctype="multipart/form-data">
				{!! csrf_field() !!}

				@include('articles.partial.form')

				<div class="sub-gallery-upload-savebtn">
					<button type="submit" class="btn btn-primary">
						저장하기
					</button>
				</div>
			</form>
		</div>
	</div>
@endsection

