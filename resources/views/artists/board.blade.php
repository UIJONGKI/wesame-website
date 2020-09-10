@extends('layouts.app')

@section('content')
@php $viewName='aritcles.index'; @endphp
	<div id="sub-artist-board">
		@include('artists.partial.list')

		<div class="sub-artist-board-main">

			@include('artists.partial.info', ['artist'=>$artist])
			<div class="artist-board-board">
				<h3>
                    BOARD
                </h3>
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
					<div>
					@forelse($articles as $article)

						@include('articles.partial.article', compact('gallery', 'viewName'))
					@empty
						<p class="text-center text-danger">글이 없습니다.</p>
					@endforelse
				</div>
				<div class="sub-artist-board-bottombtn">
					<div class="sub-artist-board-writerbtn">
						@if($currentUser==null)
						@elseif($currentUser->id===$artist->id)
							
								<a href="{{ route('articles.create') }}" class="btn btn-primary">
									글쓰기
								</a>
										
						@endif
					</div>
					
				</div>
				@if($articles->count())
					<div class="text-center">
						{!! $articles->appends(Request::except('page'))->render() !!}
					</div>
				@endif
                </div> 
                
			
				
			</div>
		</div>
	</div>

@stop