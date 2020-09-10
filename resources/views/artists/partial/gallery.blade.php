<div class="artist-board-works">
	<h3>
        GALLERY
    </h3>
	<ul class="artist-board-works-list">
	@forelse($galleries as $gallery)

		@include('galleries.partial.gallery', compact('gallery', 'viewName'))
	@empty
		<p class="text-center text-danger">글이 없습니다.</p>
	@endforelse
	</ul>
	@if($currentUser==null)
	@elseif($currentUser->id===$artist->id)
		<div class="artist-board-works-uploadbtn">
			<a href="{{ route('galleries.create') }}" class="btn btn-primary">
				UPLOAD
			</a>
		</div>
	@endif
	@if($galleries->count())
		<div class="text-center">
			{!! $galleries->appends(Request::except('page'))->render() !!}
		</div>
	@endif
</div>