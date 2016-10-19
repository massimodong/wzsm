@extends('layouts.master')

@section('title')
edit: {{$article->title}}
@endsection

@section('sidebar')
	@parent

@endsection

@section('content')

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
<textarea name='content'>{{$article->content}}</textarea>
</div>

<button type="submit" class="btn btn-default">
Submit
</button>

</form>

@endsection
