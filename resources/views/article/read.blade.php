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
<div>{!! Purifier::clean($article->content) !!}</div>
@endsection

