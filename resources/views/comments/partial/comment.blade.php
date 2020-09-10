@if ($isTrashed and ! $hasChild)
<!-- //1. 삭제된 댓글이면서 자식 댓글이 없다. 이때는 아무것도 출력할 필요가 없다. -->
@elseif($isTrashed and $hasChild)
<!-- //2. 삭제된 댓글이면서 자식 댓글이 있다. '삭제되었습니다.'라고 알리고 자식 댓글은 계속 출력한다. -->

	<div class="media item__comment {{ $isReply ? 'sub' : 'top' }}" data-id="{{ $comment->id }}" id="comment_{{$comment->id}}">
		

		<div class="media-body">
			@include('users.partial.avatar', ['user' => $comment->user, 'size'=>32])
			<h5 class="media-heading">
				<a href="#">
					{{ $comment->user->name }}
				</a>
				<small>
					{{ $comment->created_at->diffForHumans() }}
				</small>
			</h5>

			<div class="text-danger content__comment">
				<h5>삭제된 댓글입니다.</h5>
			</div>

			<div class="action__comment">
				@can('update', $comment)
					<button class="btn__delete__comment">댓글 삭제</button>
					<button class="btn__edit__comment">댓글 수정</button>
				@endcan

				@if ($currentUser)
					<button class="btn__reply__comment">댓글 쓰기</button>
				@endif
			</div>

			@if($currentUser)
		    	@include('comments.partial.create', ['parentId' => $comment->id])
		    @endif

		    @forelse($comment->replies as $reply)
				@include('comments.partial.comment', [
					'comment' => $reply,
					'isReply' => true,
					'hasChild' => $reply->replies->count(),
					'isTrashed' => $reply->trashed(),
				])
			@empty
		    @endforelse
		</div>
	</div>	

@else
	<div class="media item__comment {{ $isReply ? 'sub' : 'top' }}" data-id="{{ $comment->id }}" id="comment_{{ $comment->id }}">
		

		<div class="media-body">
			@include('users.partial.avatar', ['user' => $comment->user, 'size'=>32])
			<div style="float:left; width:85%">
				<h5 class="media-heading">
			        <a href="{{ gravatar_profile_url($comment->user->email) }}">
			          {{ $comment->user->name }}
			        </a>
			        <small>
			          {{ $comment->created_at->diffForHumans() }}
			        </small>
		      	</h5>
				
				<div class="content__comment">
					{!! markdown($comment->content) !!}
				</div>

				<div class="action__comment">
					@can('update', $comment)
						<button class="btn__delete__comment">댓글 삭제</button>
						<button class="btn__edit__comment">댓글 수정</button>
					@endcan

					@if($currentUser)
						<button class="btn__reply__comment">답글 쓰기</button>
					@endif
				</div>
			</div>
		

			@if($currentUser)
				@include('comments.partial.create', ['parentId' => $comment->id])
			@endif

			@can('update', $comment)
				@include('comments.partial.edit')
			@endcan

			@forelse($comment->replies as $reply)
				@include('comments.partial.comment', [
				'comment' => $reply,
				'isReply' => true,
				'hasChild' => $reply->replies->count(),
				'isTrashed' => $reply->trashed(),
				])
			@empty
			@endforelse
		</div>
	</div>

@endif