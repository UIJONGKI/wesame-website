@extends('layouts.app')
@section('style')
	<style>
		.img-thumbnail {width:48px;}
	</style>
@stop
@section('content')
	@php $viewName= 'articles.index'; @endphp

	<div class="sub-news-container">
		<div class="sub-news-title">
			<h3>NEWS</h3>
		</div>
		<div class="sub-news-tags">
			@include('tags.partial.index')
		</div>	
		<div class="row">
			
			<ul class="sub-news-board-nav">
				<li class="sub-news-board-nav-tags">
					카테고리
				</li>
				<li class="sub-news-board-nav-title">
					제목
				</li>
				<li class="sub-news-board-nav-writer">
					작성자
				</li>
				<li class="sub-news-board-nav-dates">
					작성날짜
				</li>
				<li class="sub-news-board-nav-views">
					조회수
				</li>
			</ul>
			<div class="col-md-9">
				<article>

				
					@forelse($articles as $article)

						@include('articles.partial.article', compact('article'))
					@empty
						<p class="text-center text-danger">글이 없습니다.</p>
					@endforelse
				</article>
				<div class="sub-news-board-bottombtn">
					
					@if($currentUser==null)
					@elseif($currentUser->admin===1)
						<div class="sub-news-board-writerbtn">
							<a href="{{ route('articles.create') }}" class="btn btn-primary">
								<i class=""></i>글 쓰기
							</a>
						</div>
					@endif
					
					
				</div>
				@if($articles->count())
					<div class="text-center">
						{!! $articles->appends(Request::except('page'))->render() !!}
					</div>
				@endif
			</div>
		</div>
	</div>

	

@stop