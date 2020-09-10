<div class="sub-news-board">
	<div class="sub-news-board-text" style="text-align: center;">
		<div class="sub-news-board-text-nav">
				<h4 class="sub-news-board-text-title">
						{{$article->title}}
				</h4>
				<p class="sub-news-board-text-writer">
						<i class="fa fa-user"></i>&nbsp;&nbsp;{{$article->user->name}}
				</p>
				<p class="sub-news-board-text-dates">
						{{$article->created_at}}
				</p>
				<p class="sub-news-board-text-views">
					<span>View</span>
			        {{ $article->view_count }}
		  		</p>
		  		<p class="sub-news-board-text-comment">
	  				<span>Comment</span>
	  				@if ($article->comment_count > 0)
		        			{{ $article->comment_count }}
		        	@endif
		  		</p>
		</div>
		<div class="sub-news-board-text-maintext">
			{!! markdown($article->content) !!}
			
		</div>
	</div>
</div>