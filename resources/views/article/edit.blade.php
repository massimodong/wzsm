@extends('layouts.master')

@section('title')
edit: {{$article->title}}
@endsection

@section('sidebar')
	@parent

@endsection

@section('content')

<head>
  <script src='/vendor/tinymce/tinymce.min.js'></script>
    <script>
      tinymce.init({
		          selector: '#content',
			  plugins: 'image imagetools paste',
			  paste_data_images: true,
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
</head>

<form action='/articles/{{$article->id}}' method='POST'>
{{csrf_field()}}
{{method_field('PUT')}}

@can ('status',$article)
	
<div><strong>Status: </strong><input type='text' name='status' value='{{$article->status}}'></input></div>

@endcan

<div><strong>Title: </strong><input type='text' name='title' value='{{$article->title}}'></input></div>

<br />
<div>
<strong>Content:</strong><br />
<textarea id='content' name='content'>{{$article->content}}</textarea>
</div>

<button type="submit" class="btn btn-default">
Submit
</button>

</form>

<form action='/articles/{{$article->id}}' method='POST'>
{{csrf_field()}}
{{method_field('DELETE')}}

<button>Delete article</button>
</form>
@endsection
