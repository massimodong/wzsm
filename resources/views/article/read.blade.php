@extends('layouts.master')
@section('title')
{{$article->title}}
@endsection

@section('content')
<div class="container"><div class="row"><div class="col-lg-12">

	<h1>{{$article->title}}</h1>
	@can('update',$article)
		<small ><a href='/articles/{{$article->id}}/edit'>edit</a></small>
	@endcan

	<p class="lead">by <a href='/users/{{$article->user->id}}'>{{$article->user->name}}</a>

	@if ( !Auth::check() || Auth::user()->voted_articles()->where('article_id',$article->id)->count()==0)
		<a class="pull-right" href="#" onclick="document.forms['vote_form'].submit(); return false;">
		<small ><span class="glyphicon glyphicon-thumbs-up"></span> 
		{{$article->votes}}</small></a></p>
	@else
		<a class="pull-right" href="#" onclick="document.forms['unvote_form'].submit(); return false;">
		<small ><span class="glyphicon glyphicon-thumbs-down"></span> 
		{{$article->votes}}</small></a></p>
	@endif

	<hr>

	<p>
	<span class="glyphicon glyphicon-time"></span>
	Last updated on {{$article->updated_at}}<br>
	</p>

	<hr>

	<div>{!! Purifier::clean($article->content) !!}</div>

	<hr>

	<div class="well">
		<h4>Leave a comment</h4>
		<form action='/articles/{{$article->id}}/comments' method='POST'>
			{{csrf_field()}}
			<div class="form-group">
				<textarea id='comment' name='content'></textarea><br/>
			</div>
			<button type='submit' class="btn btn-primary">submit</button>
		</form>
	</div>

	<hr>

	@foreach ($comments as $comment)
		<div class="media">
			<a name="comment{{$comment->id}}" class="pull-left" href='/users/{{$comment->user->id}}'>
			<img class="media-object" src='{{$comment->user->gravatar()}}?s=64'>
			</a>

			<div class="media-body">
				<h4 class="media-heading">
				{{$comment->user->name}}
				<small>{{$comment->created_at}}
				@can ('update',$comment)
				<form action='/articles/{{$article->id}}/comments/{{$comment->id}}' method='POST'>
					{{csrf_field()}}
					{{method_field('DELETE')}}
					<a href="#" onclick="$(this).closest('form').submit();">del</a>
				</form>
				@endcan
				</small>
				</h4>
			
				{!! Purifier::clean($comment->content,'comment') !!}
			</div>

			@if ( !Auth::check() || Auth::user()->voted_comments()->where('comment_id',$comment->id)->count()==0)
			@else
			@endif
			
		</div>
	@endforeach

</div></div></div>

<form name="vote_form" action='/articles/{{$article->id}}/vote' method='POST'>
{{csrf_field()}}
</form>

<form name="unvote_form" action='/articles/{{$article->id}}/vote' method='POST'>
{{csrf_field()}}
{{method_field('DELETE')}}
</form>
@endsection

@section('scripts')
<script src='/vendor/tinymce/tinymce.min.js'></script>
<script>
      tinymce.init({
		          selector: '#comment',
			  language_url: '/include/js/tinyMCE/zh_CN.js',
			  plugins: 'autolink contextmenu paste',
			  menubar: false,
			  toolbar: false,
			  valid_elements : 'a[href|target=_blank],strong/b,div[align],br,p',
			  contextmenu: 'bold paste'
			    });
</script>
@endsection
