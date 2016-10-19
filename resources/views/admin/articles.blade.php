@extends('admin.layouts.master')

@section('title', 'Articles')

@section('sidebar')
@parent

@endsection

@section('content')

<table>
	<tr>
		<th>Article Id</th> <th>Author</th> <th>Title</th> <th>Status</th>
	</tr>
	@foreach ($articles as $article)
	<tr>
		<th><a href='/articles/{{$article->id}}'>{{$article->id}}</a></th>
		<th><a href='/users/{{$article->user->id}}'>{{$article->user->name}}</a></th>
		<th><a href='/articles/{{$article->id}}'>{{$article->title}}</a></th>
		<th><a href='/articles/{{$article->id}}'>{{$article->status}}</a></th>
	</tr>
	@endforeach
</table>

@endsection

