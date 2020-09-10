@extends('layouts.app')
@section('style')
	<style>
		.img-thumbnail {width:48px;}
	</style>
	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/shop-gallery-detail.css')}}">
@stop
@section('content')
	@php $viewName = 'galleries.show'; @endphp
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/ko_KR/sdk.js#xfbml=1&version=v2.10&appId=199837473830999";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div id="containerWrap">
		
		 <div class="sub-gallery-detail">
			@include('galleries.partial.gallery', compact('gallery'))
			<div class="text-center action__article sub-news-board-show-btn-area">
				
				@can('update', $gallery)
					<div class="sub-news-board-show-btn sub-news-board-show-editbtn">
						<a href="{{ route('galleries.edit', $gallery->id) }}" class="btn btn-info">
							<i class="fa fa-pencil"></i> 글 수정
						</a>
			
					</div>
				@endcan
				@can('delete', $gallery)
					<div class="sub-news-board-show-btn sub-news-board-show-delbtn">
						<button class="btn btn-danger button__delete">
							<i class="fa fa-trash-o"></i> 글 삭제
						</button>
				</div>
				@endcan
				<div class="sub-news-board-show-btn sub-news-board-show-listbtn">
					<a href="{{ route('galleries.index') }}" class="btn btn-default">
						<i class="fa fa-list"></i> 글 목록
					</a>
				</div>
				
			</div>
			<div class="container_comment">
				@include('gcomments.index')
			</div>
		</div>
	</div>

@stop

@section('script')
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$('.button__delete').on('click', function(e){
			var galleryId = '{{ $gallery->id }}';

			if(confirm('글을 삭제합니다.')) {
				$.ajax({
					type: 'DELETE',
					url: '/galleries/' + galleryId
				}).then(function(){
					window.location.href = '/galleries';
				});
			}
		});
	</script>
@stop