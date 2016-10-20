@extends('admin.layouts.master')

@section('title', 'Users')

@section('sidebar')
@parent

@endsection

@section('content')

<div>
<table>
	<tr>
		<th>id</th>
		<th>name</th> 
		<th>email</th>
		<th>role</th>
		<th></th>
	</tr>
@foreach ($users as $user)
	<tr>
		<td>{{$user->id}}</td>
		<td>{{$user->name}}</td> 
		<td>{{$user->email}}</td>
		<td>{{$user->role}}</td>
		<td><a href='/users/{{$user->id}}'>edit</a></td>
	</tr>
@endforeach
</table>
</div>

@endsection

