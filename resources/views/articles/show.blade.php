@extends('layouts.app')
@section('style')
	<style>
		.img-thumbnail {width:48px;}
	</style>
@stop
@section('content')
	@php $viewName='articles.show'; @endphp
	
	<div class="sub-news-board-show">
		<article data-id="{{ $article->id }}">
			@include('articles.partial.articlesDetail', compact('article'))

		

			
		</article>

		<div class="text-center action__article sub-news-board-show-btn-area">
			@can('update', $article)
				<div class="sub-news-board-show-btn sub-news-board-show-editbtn">
					<a href="{{ route('articles.edit', $article->id) }}" class="btn btn-info">
						<i class="fa fa-pencil"></i> 글 수정
					</a>
		
				</div>
			@endcan
			@can('delete', $article)
				<div class="sub-news-board-show-btn sub-news-board-show-delbtn">
					<button class="btn btn-danger button__delete">
						<i class="fa fa-trash-o"></i> 글 삭제
					</button>
			</div>
			@endcan
			<div class="sub-news-board-show-btn sub-news-board-show-listbtn">
				<a href="{{ route('articles.index') }}" class="btn btn-default">
					<i class="fa fa-list"></i> 글 목록
				</a>
			</div>
		</div>
		<div class="container_comment">
			@include('comments.index')
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
			var articleId = $('article').data('id');

			if(confirm('글을 삭제합니다.')) {
				$.ajax({
					type: 'DELETE',
					url: '/articles/' + articleId
				}).then(function(){
					window.location.href = '/articles';
				});
			}
		});
	</script>
@stop