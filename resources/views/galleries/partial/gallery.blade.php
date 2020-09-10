
@if($viewName=='galleries.index')
<li>
	<a href="{{ route('galleries.show', $gallery->id) }}" title="">
		<p class="sub-gallery-works-img">
			@if(count($gallery->attachments)==0)
			<img alt="work" src="{{ URL::asset('img/artist1.jpg') }}"/>
			@else
			<img alt="work" src="{{'https://s3.ap-northeast-2.amazonaws.com/wesameimages/files/'.$gallery->attachments[0]->filename}}"/>
			@endif
		</p>
		<div class="sub-gallery-works-text">
			<div class="sub-gallery-work-profile">
				@include('users.partial.avatar', ['user' => $gallery->user])
			</div>
			<p class="sub-gallery-works-text-name">
				<span class="sub-gallery-works-text-worksname">
					{{ $gallery->title }}
				</span>
				<span class="sub-gallery-works-text-artistname">
					{{ $gallery->user->name }}
				</span>
			</p>
		</div>
	</a>
</li>
@elseif($viewName=='artists.show')
<li>
	<a href="{{ route('galleries.show', $gallery->id) }}" title="">
		<p class="artist-board-works-list-img">
			@if(count($gallery->attachments)==0)
			<img alt="work" src="{{ URL::asset('img/artist1.jpg') }}"/>
			@else
			<img alt="work" src="{{'https://s3.ap-northeast-2.amazonaws.com/wesameimages/files/'.$gallery->attachments[0]->filename}}"/>
			@endif
		</p>
		<div class="artist-board-works-list-text">
			<p class="artist-board-works-list-text-name">
				<span class="artist-board-works-list-text-worksname">
					{{ $gallery->title }}
				</span>
				<span class="artist-board-works-list-text-artistname">
					{{ $gallery->user->name }}
				</span>
			</p>
		</div>
	</a>
</li>
@elseif($viewName=='galleries.show')
<div class="sub-gallery-detail-goods">
	<div class="goods-img">
		@if(count($gallery->attachments)==0)
			<img alt="work" src="{{ URL::asset('img/artist1.jpg') }}"/>
			@else
			<img alt="work" src="{{	'https://s3.ap-northeast-2.amazonaws.com/wesameimages/files/'.$gallery->attachments[0]->filename}}"/>
			@endif
	</div>
	<div class="goods-text">
		<h4 class="goods-title">
			{{$gallery->title}}
		</h4>
		<dl class="goods-artist">
			<dt>Artist</dt><dd>{{$gallery->user->name}}</dd>
		</dl>
		<dl class="goods-info">
			<dt>Category</dt><dd>@include('gtags.partial.list', ['gtags' => $gallery->gtags])</dd>
		</dl>
		<div class="goods-notice">
			<h4>Description</h4>
			<strong>
				<p>{{$gallery->content}}</p>
			</strong>
		</div>
		@if(isset($currentUser))
		<div class="fb-like" data-href="http://www.wesame.co.kr/galleries/{{$gallery->id}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
		@else
		@endif
	</div>


</div>


	<div class="sub-gallery-detail-notice">
		@if(count($gallery->attachments)==0)
		<p>추가 작품 사진이없습니다.</p>
		@else
		<div class="notice-img">
			@forelse($gallery->attachments as $attachment)
			<img src="{{'https://s3.ap-northeast-2.amazonaws.com/wesameimages/files/'.$attachment->filename}}"/>
			@empty
			<p>없습니다.</p>
			@endforelse
		</div>
		@endif
	</div>

	
@endif

