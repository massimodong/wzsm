@extends('admin.layouts.master')

@section('title', 'Articles')

@section('sidebar')
@parent

@endsection

@section('content')

<div>
<table>
	<tr>
		<th>Article Id</th> <th>Author</th> <th>Title</th> <th>Status</th> <th>Top</th>
	</tr>
	@foreach ($articles as $article)
	<tr>
		<th><a href='/articles/{{$article->id}}'>{{$article->id}}</a></th>
		<th><a href='/users/{{$article->user->id}}'>{{$article->user->name}}</a></th>
		<th><a href='/articles/{{$article->id}}'>{{$article->title}}</a></th>
		<th><a href='/articles/{{$article->id}}'>{{$article->status}}</a></th>
		<th><a href='/articles/{{$article->id}}'>{{$article->top}}</a></th>
	</tr>
	@endforeach
</table>
</div>

<div>
<h4>Options</h4>
@include ('admin.layouts.optionform',['options'=>[
	['verify_articles','Verify Articles Mode'],
]])
</div>

@endsection

