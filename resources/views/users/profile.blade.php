@extends('layouts.master')

@section('title')
{{$user->name}}
@endsection

@section('sidebar')
	@parent

@endsection

@section('content')

<div>
@can ('update',$user)
	<form action='/users/{{$user->id}}' method='POST'>
		{{csrf_field()}}
		{{method_field('PUT')}}

		<a>name:</a><input type='text' name='name' value='{{$user->name}}'><br/>
		<a>email:</a><input type='text' name='email' value='{{$user->email}}' disabled><br/>
		<a>role:</a><input type='text' name='role' value='{{$user->role}}' 
		@can ('changeRole',$user)
		@else
			disabled
		@endcan
		><br/>
		<a>password:</a><input type='password' name='password' value=''><br/>
		<button type='submit' class="btn btn-default">Change</button>
	</form>
@else
	<div>
		<p>name:{{$user->name}}</p>
		<p>email:{{$user->email}}</p>
	</div>
@endcan

</div>

@endsection

