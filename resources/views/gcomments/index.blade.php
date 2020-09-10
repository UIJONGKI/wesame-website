<div class="page-header">
	<h4>댓글</h4>
</div>

<div class="form__new__comment">
	@if($currentUser)
		@include('gcomments.partial.create')
	@else
		@include('gcomments.partial.login')
	@endif
</div>
<div class="list__comment">
	@forelse($gcomments as $gcomment)
		@include('gcomments.partial.comment', [
		'parentId' => $gcomment->id,
		'isReply' => false,
		'hasChild' => $gcomment->replies->count(),
		'isTrashed' => $gcomment->trashed(),
		])
	@empty
	@endforelse
</div>


@section('script')
	@parent
	<script>
		$('.btn__delete__comment').on('click', function(e) {
			var gcommentId = $(this).closest('.item__comment').data('id'), galleryId = $('gallery').data('id');

			if (confirm('댓글을 삭제합니다.')) {
				$.ajax({
					type:'POST',
					url: "/gcomments/" + gcommentId,
					data: {
						_method: "DELETE"
					}
				}).then(function() {
					$('#comment_' + gcommentId).fadeOut(1000, function() {
						$(this).remove();
					});
				})
			}

		});
		// 대댓글 폼을 토글한다.
	    $('.btn__reply__comment').on('click', function(e) {
	      var el__create = $(this).closest('.item__comment').find('.media__create__comment').first(),
	        el__edit = $(this).closest('.item__comment').find('.media__edit__comment').first();
	      el__edit.hide('fast');
	      el__create.toggle('fast').end().find('textarea').focus();
	    });
	    // 댓글 수정 폼을 토글한다.
	    $('.btn__edit__comment').on('click', function(e) {
	      var el__create = $(this).closest('.item__comment').find('.media__create__comment').first(),
	        el__edit = $(this).closest('.item__comment').find('.media__edit__comment').first();
	      el__create.hide('fast');
	      el__edit.toggle('fast').end().find('textarea').first().focus();
	    });

		

		

	</script>
@stop