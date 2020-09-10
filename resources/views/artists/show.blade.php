@extends('layouts.app')
@section('style')
	<style>
		.img-thumbnail {width: 48px;}
	</style>
@stop
@section('content')
@php $viewName = 'artists.show'; @endphp
	<div id="sub-artist-board">
		@include('artists.partial.list')

		<div class="sub-artist-board-main">
	
			@include('artists.partial.info', ['artist'=>$artist])
	
			@include('artists.partial.gallery', ['artist'=>$artist, 'galleries'=>$galleries])

		</div>
	</div>
@stop