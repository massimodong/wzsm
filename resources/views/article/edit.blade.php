@extends('layouts.master')

@section('title')
{{trans('wzsm.edit')}}: {{$article->title}}
@endsection

@section('sidebar')
@parent
<li><a href="#" onclick="document.forms['article_form'].submit(); return false;">
		       <span class="glyphicon glyphicon-save-file"></span> {{trans('wzsm.save')}}</a>
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
			> {{trans('wzsm.top')}}
		</label>
	</div>
@endcan

@can ('status',$article)
<div>
	<select name='status' class="form-control" >
		@if($article->status === 'accepted')
		<option value='accepted'>{{trans('wzsm.accept')}}</option>
		<option value='rejected'>{{trans('wzsm.reject')}}</option>
		@else
		<option value='rejected'>{{trans('wzsm.reject')}}</option>
		<option value='accepted'>{{trans('wzsm.accept')}}</option>
		@endif
	</select>
</div>
<hr>
@endcan

<div class="form-group">
    <label for="title">{{trans('wzsm.title')}}</label>
    <input type="text" class="form-control" id="title"
    name="title"  value="{{$article->title}}" placeholder="{{trans('wzsm.title')}}">
</div>

<div class="form-group">
    <label for="description">{{trans('wzsm.description')}}</label>
    <textarea class="form-control" id="description" style="resize:none"
    name="description" placeholder="{{trans('wzsm.a_brief_description')}}">{{$article->description}}</textarea>
</div>

<div class="row">
	<div class="form-group col-lg-11">
		<label for="sample_image">{{trans('wzsm.home_image')}}</label>
	      	<input type="text" class="form-control" id="sample_image"
		name="image"  value="{{$article->image}}" placeholder="{{trans('wzsm.home_image_hint')}}">
	</div>
	<div class="form-group col-lg-1">
		@if ($article->image <> '')
		<img src="{{$article->image}}" class="img-thumbnail">
		@endif
	</div>
</div>

<div class="form-group">
    <textarea id='content' name='content'>{{$article->content}}</textarea>
</div>

</form>

<form action='/articles/{{$article->id}}' method='POST' onsubmit="return confirm('{{trans('wzsm.really_delete')}}');">
{{csrf_field()}}
{{method_field('DELETE')}}

<button type="submit" class="btn btn-danger">{{trans('wzsm.delete_article')}}</button>
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
	    extended_valid_elements : 'img[class=img-responsive|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name]',
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

