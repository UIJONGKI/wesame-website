<div class="artist-gallery-category">
<ol>
	<li>
		<a href="{{url('/')}}">All</a>
	</li>
	@foreach($allGtags as $gtag)
		<li {!! str_contains(request()->path(), $gtag->slug) ? 'class="active"' : ''!!} >
			<a href="{{ route('home.gtags.index', $gtag->slug) }}" title="{{$gtag->slug}}">
				{{ $gtag->name }}
			</a>
		</li>
	@endforeach
</ol>
</div>