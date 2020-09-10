@if ($tags->count())
	<p class="sub-news-board-text-tags">
		@foreach ($tags as $tag)
			<a href="{{ route('tags.articles.index', $tag->slug) }}">{{ $tag->name }}</a>
		@endforeach
	</u\p>
@endif