@extends('layouts.master')

@section('title')
{{$user->name}}
@endsection

@section('sidebar')
	@parent

@endsection

@section('content')

<div>
<img src='{{$user->gravatar()}}?s=80'>
</div>

<div>
@can ('update',$user)
	<form action='/users/{{$user->id}}/profile' method='POST'>
		{{csrf_field()}}
		{{method_field('PUT')}}

		<a>name:</a><input type='text' name='name' value='{{$user->name}}'><br/>
		<a>fullname:</a><input type='text' name='fullname' value='{{$user->fullname}}'><br/>
		<a>email:</a><input type='text' name='email' value='{{$user->email}}' disabled><br/>
		<a>role:</a><input type='text' name='role' value='{{$user->role}}' 
		@can ('changeRole',$user)
		@else
			disabled
		@endcan
		><br/>
		<a>password:</a><input type='password' name='password' value=''><br/>
		<a> confirm:</a><input type='password' name='password_confirmation' value=''><br/>
		<button type='submit' class="btn btn-default">Change</button>
	</form>
@else
	<div>
		<p>name:{{$user->name}}</p>
		<p>fullname:{{$user->fullname}}</p>
		<p>email:{{$user->email}}</p>
	</div>
@endcan

</div>

<div>
<h3>Articles</h3>
<table>
	<tr>
	<th>Title</th> <th>Status</th>
	</tr>
	@foreach ($articles as $article)
	<tr>
	<td><a href='/articles/{{$article->id}}'>{{$article->title}}</a></td>
	<td><a href='/articles/{{$article->id}}'>{{$article->status}}</a></td>
	</tr>
	@endforeach
</table
</div>

@endsection

