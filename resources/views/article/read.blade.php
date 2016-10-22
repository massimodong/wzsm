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
<small>({{$article->views}} views)</small>
<div>{!! Purifier::clean($article->content) !!}</div>

<div>
<h4>Comments:</h4>
@foreach ($comments as $comment)
	<p>
		<strong>{{$comment->user->name}}:</strong>{{$comment->content}}
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

<div>
<h4>Leave a comment:</h4>
<form action='/articles/{{$article->id}}/comments' method='POST'>
	{{csrf_field()}}
	<textarea name='content'></textarea><br/>
	<button type='submit'>submit</button>
</form>
</div>
@endsection

