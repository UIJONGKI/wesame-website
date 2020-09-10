@if ($gtags->count())
	<ul>
		@foreach ($gtags as $gtag)
			<li><a href="{{ route('gtags.galleries.index', $gtag->slug) }}">{{ $gtag->name }}</a></li>
		@endforeach
	</ul>
@endif