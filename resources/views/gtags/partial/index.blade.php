<ul class="sub-gallery-nav-size">
	@foreach($allGtags as $gtag)
		<li {!! str_contains(request()->path(), $gtag->slug) ? 'class="active"' : ''!!}>
			<a href="{{ route('gtags.galleries.index', $gtag->slug) }}">
				{{ $gtag->name }}
				<!--@if ($count = $gtag->galleries->count())
					<span class="badge badge-default">{{ $count }}</span>
				@endif-->
			</a>
		</li>
	@endforeach
</ul>