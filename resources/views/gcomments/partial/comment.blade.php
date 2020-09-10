@if ($isTrashed and ! $hasChild)
<!-- //1. 삭제된 댓글이면서 자식 댓글이 없다. 이때는 아무것도 출력할 필요가 없다. -->
@elseif($isTrashed and $hasChild)
<!-- //2. 삭제된 댓글이면서 자식 댓글이 있다. '삭제되었습니다.'라고 알리고 자식 댓글은 계속 출력한다. -->

	<div class="media item__comment {{ $isReply ? 'sub' : 'top' }}" data-id="{{ $gcomment->id }}" id="comment_{{$gcomment->id}}">
		@include('users.partial.avatar', ['user' => $gcomment->user, 'size'=>32])

		<div class="media-body">
			<h5 class="media-heading">
				<a href="#">
					{{ $gcomment->user->name }}
				</a>
				<small>
					{{ $gcomment->created_at->diffForHumans() }}
				</small>
			</h5>

			<div class="text-danger content__comment">
				<h5>삭제된 댓글입니다.</h5>
			</div>

			<div class="action__comment">
				@can('update', $gcomment)
					<button class="btn__delete__comment">댓글 삭제</button>
					<button class="btn__edit__comment">댓글 수정</button>
				@endcan

				@if ($currentUser)
					<button class="btn__reply__comment">댓글 쓰기</button>
				@endif
			</div>

			@if($currentUser)
		    	@include('gcomments.partial.create', ['parentId' => $gcomment->id])
		    @endif

		    @forelse($gcomment->replies as $reply)
				@include('gcomments.partial.comment', [
					'gcomment' => $reply,
					'isReply' => true,
					'hasChild' => $reply->replies->count(),
					'isTrashed' => $reply->trashed(),
				])
			@empty
		    @endforelse
		</div>
	</div>	
@else
<div class="media item__comment {{ $isReply ? 'sub' : 'top' }}" data-id="{{ $gcomment->id }}" id="comment_{{ $gcomment->id }}">
		@include('users.partial.avatar', ['user' => $gcomment->user, 'size'=>32])

		<div class="media-body">
			<h5 class="media-heading">
		        <a href="#">
		          {{ $gcomment->user->name }}
		        </a>
		        <small>
		          {{ $gcomment->created_at->diffForHumans() }}
		        </small>
	      	</h5>
			
			<div class="content__comment">
				{!! markdown($gcomment->content) !!}
			</div>

			<div class="action__comment">
				@can('update', $gcomment)
					<button class="btn__delete__comment">댓글 삭제</button>
					<button class="btn__edit__comment">댓글 수정</button>
				@endcan

				@if($currentUser)
					<button class="btn__reply__comment">답글 쓰기</button>
				@endif
			</div>
		

			@if($currentUser)
				@include('gcomments.partial.create', ['parentId' => $gcomment->id])
			@endif

			@can('update', $gcomment)
				@include('gcomments.partial.edit')
			@endcan

			@forelse($gcomment->replies as $reply)
				@include('gcomments.partial.comment', [
				'gcomment' => $reply,
				'isReply' => true,
				'hasChild' => $reply->replies->count(),
				'isTrashed' => $reply->trashed(),
				])
			@empty
			@endforelse
		</div>
	</div>

@endif