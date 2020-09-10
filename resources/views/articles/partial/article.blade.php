<div class="sub-news-board">
	<!--썸네일 넣을 곳
	<div class="sub-news-board-img">
		@if($viewName === 'articles.index')
			@if(count($article->attachments)==0)
			<img class="img-thumbnail" src="{{URL::asset('img/wesame-newLogo.jpg')}}"/>
			@else
			<img class="img-thumbnail" src="{{$article->attachments[0]->url}}"/>
			@endif
		@endif
	</div>
	-->
	
	<!-- 글 목록 -->

	<div class="msub-news-board-text">
		@include('tags.partial.list', ['tags'=>$article->tags])
			<h4 class="sub-news-board-text-title">
				<a href="{{ route('articles.show', $article->id) }}">
					{{ $article->title }}
			    </a>
			    <span>
					@if ($article->comment_count > 0)
			        	({{ $article->comment_count }})
			        @endif
		        </span>
			</h4>
		<p class="sub-news-board-text-writer">
			<a href="#">
				<i class="fa fa-user"></i>&nbsp;&nbsp;{{ $article->user->name }}
			</a>
		</p>
		<p class="sub-news-board-text-dates">
			{{ $article->created_at->format('d M Y') }}
		</p>
		<p class="sub-news-board-text-views">
	        
	        {{ $article->view_count }}
  		</p>
  		
		
	</div>
</div>
