@extends('layouts.app')
@section('style')
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/shop-gallery-detail.css')}}">
@stop
@section('content')
	<div class="sub-gallery-upload-container">
		<h3>
			Gallery Upload
		</h3>
		<hr/>
		<div class="sub-gallery-upload">
			<form action="{{ route('galleries.store') }}" method="POST" class="form__article" enctype="multipart/form-data">
				{!! csrf_field() !!}

				@include('galleries.partial.form')

				<div class="sub-gallery-upload-savebtn">
					<button type="submit" class="btn btn-primary">
						저장하기
					</button>
				</div>
			</form>
		</div>
	</div>
@stop