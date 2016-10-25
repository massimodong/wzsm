@extends('layouts.master')

@section('title','Images')

@section('sidebar')
	@parent
@endsection

@section('content')

@foreach ($images as $image)
	<a>id:{{$image->id}}</a><img src='{{$image->getUrl()}}' alt='{{$image->id}}' width='100' height='100'>
	<form action='/images/{{$image->id}}' method='POST'>
		{{csrf_field()}}
		{{method_field('DELETE')}}
		<button type='submit'>delete</button>
	</form>
	<br>
@endforeach

@endsection
