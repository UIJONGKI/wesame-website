<div class="media media__edit__comment">
	<div class="media-body">
		<form method="POST" action="{{ route('gcomments.update', $gcomment->id) }}" class="form-horizontal">
			{!! csrf_field() !!}
			{!! method_field('PUT') !!}

			<div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
				<textarea name="content" class="form-control">
					{{ old('content', $gcomment->content) }}
				</textarea>
				{!! $errors->first('content', '<span class="form-error">:message</span>') !!}
				<div class="preview__content">
					{!! markdown(old('content')) !!}
				</div>
			</div>

			<div class="text-right">
				<button type="submit" class="btn btn-primary btn-sm">
					댓글쓰기
				</button>
			</div>
		</form>
	</div>
</div>