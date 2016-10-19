@extends('layouts.master')

@section('title','Home')

@section('sidebar')
	@parent
@endsection

@section('content')
<h3>Articles:</h3>
<div>
@foreach ($articles as $article)
<p><a href='/articles/{{$article->id}}'>{{$article->title}}</a></p>
@endforeach
</div>
@endsection
