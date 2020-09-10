<div class="sub-gallery-upload-title {{ $errors->has('title') ? 'has-error' : '' }}">
	<label for="title">제목</label>
	<input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" class="form-control" />
	{!! $errors->first('title', '<span class="form-error">:message</span>') !!}	
</div>

<div class="sub-gallery-upload-tags {{ $errors->has('tags') ? 'has-error' : '' }}">
	<label for="tags">태그</label>
	<select class="form-control" name="tags[]" id="tags" multiple="multiple">
		@foreach($allTags as $tag)
			<option value="{{ $tag->id }}" {{ $article->tags->contains($tag->id) ? 'selected="selected"' : '' }}>
				{{ $tag->name }}
			</option>
		@endforeach
	</select>
	{!! $errors->first('tags', '<span class="form-error">:message</span>') !!}
</div>

<div class="sub-gallery-upload-text {{ $errors->has('content') ? 'has-error' : '' }}">
	<label for="content">본문</label>
	<textarea name="content" id="content" rows="10" class="form-control my-editor">{!! old('content', $article->content) !!}</textarea>
	{!! $errors->first('content', '<span class="form-error">:message</span>') !!}

  <div class="preview__content">
    {!! markdown(old('content', '...')) !!}
  </div>
</div>



@section('script')
  @parent
  <script src="{{URL::asset('js/tinymce.min.js')}}"></script>
  <script>
    // tiny Editor
    var editor_config = {
      path_absolute : "/",
      selector: "textarea.my-editor",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };

    tinymce.init(editor_config);
    
    /* select2 */
    $('#tags').select2({

      placeholder: '태그를 선택하세요 (최대1개)',
      maximumSelectionLength: 1
    });

    
    
  </script>
@stop

@section('style')
  <style type="text/css">
  
    .select2 {
      width:100% !important;
    }
  </style>
@stop