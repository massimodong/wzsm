@extends('layouts.master')

@section('title')
edit: {{$article->title}}
@endsection

@section('sidebar')
@parent
<li><a href="#" onclick="document.forms['article_form'].submit(); return false;">
		       <span class="glyphicon glyphicon-save-file"></span> save</a>
</i>
@endsection

@section('content')
<div class="container"><div class="row"><div class="col-lg-12">

<form action='/articles/{{$article->id}}' method='POST' name='article_form'>
{{csrf_field()}}
{{method_field('PUT')}}

@can ('top',$article)
	<div class="checkbox">
		<label>
			<input type="checkbox" name="top" value="1"
			@if($article->top)
			checked
			@endif
			> Top
		</label>
	</div>
@endcan

@can ('status',$article)
<div>
	<select name='status' class="form-control" >
		@if($article->status === 'accepted')
		<option value='accepted'>accept</option>
		<option value='rejected'>reject</option>
		@else
		<option value='rejected'>reject</option>
		<option value='accepted'>accept</option>
		@endif
	</select>
</div>
<hr>
@endcan

<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title"  value="{{$article->title}}" placeholder="Title">
</div>

<div class="form-group">
    <label for="content">Content</label>
    <textarea id='content' name='content'>{{$article->content}}</textarea>
</div>

</form>

<form action='/articles/{{$article->id}}' method='POST' onsubmit="return confirm('Do you really want to submit the form?');">
{{csrf_field()}}
{{method_field('DELETE')}}

<button type="submit" class="btn btn-danger">Delete article</button>
</form>
</div></div></div>
@endsection

@section('scripts')
<script src='/vendor/tinymce/tinymce.min.js'></script>
<script>
      tinymce.init({
	    selector: '#content',
	    language_url: '/include/js/tinyMCE/zh_CN.js',
	    theme: 'modern',
	    height: 800,
	    plugins: 'image imagetools paste autolink autosave code codesample textcolor contextmenu fullscreen link lists media preview save searchreplace colorpicker ',
	    menubar:false,
	    toolbar: "undo redo | styleselect formatselect fontselect fontsizeselect | forecolor bold italic underline strikethrough subscript superscript | alignleft aligncenter alignright alignjustify | link image media codesample | bullist numlist outdent indent | removeformat | code searchreplace | fullscreen preview | newdocument | save ",
	    contextmenu: "link image inserttable | cell row column deletetable | paste",
	    paste_data_images: true,
	    imagetools_cors_hosts: ['{{env('IMAGES_CORS')}}'],
	    images_upload_handler: function (blobInfo, success, failure) {

	    var xhr, formData;

	    xhr = new XMLHttpRequest();
	    xhr.withCredentials = false;
	    xhr.open('POST', '/images');

	    xhr.onload = function() {
		    var json;

		    if (xhr.status != 200) {
			    failure('HTTP Error: ' + xhr.status);
			    return;
		    }

		    json = JSON.parse(xhr.responseText);

		    if (!json || typeof json.location != 'string') {
			    failure('Invalid JSON: ' + xhr.responseText);
			    return;
		    }

		    success(json.location);
	    };

	    formData = new FormData();
	    formData.append('file', blobInfo.blob(), blobInfo.filename());
	    formData.append('_token','{{csrf_token()}}');

	    xhr.send(formData);
	    }
      });
</script>
@endsection

