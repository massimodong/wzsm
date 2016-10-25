@extends('layouts.master')

@section('title')
{{$article->title}}
@endsection

@section('sidebar')
	@parent
	@can('update',$article)
		<a href='/articles/{{$article->id}}/edit'>edit</a>
	@endcan

@endsection

@section('content')
<h4>{{$article->title}}</h4>
<small>({{$article->views}} views,{{$article->votes}} votes)</small>

@if ( !Auth::check() || Auth::user()->voted_articles()->where('article_id',$article->id)->count()==0)
<form action='/articles/{{$article->id}}/vote' method='POST'>
{{csrf_field()}}
<button type='submit'>Vote</button>
</form>
@else
<form action='/articles/{{$article->id}}/vote' method='POST'>
{{csrf_field()}}
{{method_field('DELETE')}}
<button type='submit'>Unvote</button>
</form>
@endif

<div>{!! Purifier::clean($article->content) !!}</div>

<div>
<h4>Comments:</h4>
@foreach ($comments as $comment)
	<p>
		<strong>{{$comment->user->name}}:</strong>
		{!! Purifier::clean($comment->content,'comment') !!}
		<small>({{$comment->votes}} votes)</small>

		@if ( !Auth::check() || Auth::user()->voted_comments()->where('comment_id',$comment->id)->count()==0)
		<form action='/articles/{{$article->id}}/comments/{{$comment->id}}/vote' method='POST'>
		{{csrf_field()}}
		<button type='submit'>Vote</button>
		</form>
		@else
		<form action='/articles/{{$article->id}}/comments/{{$comment->id}}/vote' method='POST'>
		{{csrf_field()}}
		{{method_field('DELETE')}}
		<button type='submit'>Unvote</button>
		</form>
		@endif

		@can ('update',$comment)
		<form action='/articles/{{$article->id}}/comments/{{$comment->id}}' method='POST'>
		{{csrf_field()}}
		{{method_field('DELETE')}}
		<button type='submit' class="btn btn-default">del</button>
		</form>
		@endcan
	</p>
@endforeach
</div>

<head>
  <script src='/vendor/tinymce/tinymce.min.js'></script>
    <script>
      tinymce.init({
		          selector: '#comment',
			  language_url: '/include/js/tinyMCE/zh_CN.js',
			  width: 500,
			  height: 100,
			  plugins: 'autolink contextmenu paste',
			  menubar: false,
			  toolbar: false,
			  valid_elements : 'a[href|target=_blank],strong/b,div[align],br',
			  contextmenu: 'bold paste'
			    });
</script>
</head>

<div>
<h4>Leave a comment:</h4>
<form action='/articles/{{$article->id}}/comments' method='POST'>
	{{csrf_field()}}
	<textarea id='comment' name='content'></textarea><br/>
	<button type='submit'>submit</button>
</form>
</div>
@endsection

