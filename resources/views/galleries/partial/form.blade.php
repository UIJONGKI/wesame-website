<div class="sub-gallery-upload-title {{ $errors->has('title') ? 'has-error' : '' }}">
	<label for="title">제목</label>
	<input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}" class="form-control" />
	{!! $errors->first('title', '<span class="form-error">:message</span>') !!}
</div>
<div class="sub-gallery-upload-tags {{ $errors->has('gtags') ? 'has-error' : '' }}">
	<label for="tags">태그</label>
	<select class="form-control" name="gtags[]" id='gtags' multiple="multiple">
		@foreach($allGtags as $gtag)
			<option value="{{ $gtag->id }}" {{ $gallery->gtags->contains($gtag->id) ? 'selected="selected"' : ''}}>
			{{ $gtag->name }}
			</option>
		@endforeach
	</select>
	{!! $errors->first('gtags', '<span class="form-error">:message</span>') !!}
</div>

<div class="sub-gallery-upload-text {{ $errors->has('content') ? 'has-error' : '' }}">
	<label for="content">본문</label>
	<textarea name="content" id="content" rows="10" class="form-control">{{ old('content', $gallery->content) }}</textarea>
	{!! $errors->first('content', '<span class="form-error">:message</span>') !!}
	<div class="preview__content">
    {!! markdown(old('content', '...')) !!}
  </div>
</div>
<div class="sub-gallery-upload-files {{ $errors->has('files') ? 'has-error' : '' }}">
  <label for="files">작품 이미지 (3개 이상)</label>
  @if(count($gallery->attachments)==0)
  <input type="file" name="files[]" value="" id="files" class="form-control" multiple="" />
  @else
  	@foreach($gallery->attachments as $attachment)
  	<p>{{$attachment->filename}}</p>
  	@endforeach
  	<a class="delete__thumb" href="{{route('galleries.delete', $gallery->id)}}">
    	이미지 삭제
  	</a>
  @endif
  {!! $errors->first('files', '<span class="form-error">:message</span>') !!}
  {!! $errors->first('files.0', '<span class="form-error">:message</span>') !!}
</div>
<!--<div class="form-group">
  <label for="my-dropzone">이미지 업로드 
    <small class="text-muted">
      *필수
      <i class="fa fa-chevron-down"></i>
        열기
    </small>
    <small class="text-muted" style="display: none;">
      *필수
      <i class="fa fa-chevron-up"></i>
      닫기
    </small>
  </label>

  <div id="my-dropzone" class="dropzone"></div>
</div>-->

@section('script')
	@parent
	
  	<script>
		/* select2 */
	    $('#gtags').select2({
	      placeholder: '태그를 선택하세요 (최대3개)',
	      maximumSelectionLength: 3
	    });
    /* 줄바꿈 */
   
	</script>
@stop