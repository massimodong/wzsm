@extends('layouts.master')

@section('title')
edit {{$user->name}}
@endsection

@section('content')

<div class="container">
<div class="row">
<div class="col-md-12">
	<form action="/users/{{$user->id}}/profile" method="POST">
	{{csrf_field()}}
	{{method_field('PUT')}}
	<div class="form-group">
		<label for="inputName">Name</label>
		<input type="text" class="form-control" id="inputName" 
		name="name" placeholder="Name" value="{{$user->name}}">
	</div>

	<form>
	<div class="form-group">
		<label for="inputFullname">Full Name</label>
		<input type="text" class="form-control" id="inputFullname"
		name="fullname" placeholder="Full Name" value="{{$user->fullname}}">
	</div>

	<form>
	<div class="form-group">
		<label for="inputEmail">Email</label>
		<input type="email" class="form-control" id="inputEmail"
		name="email" placeholder="Email" value="{{$user->email}}" disabled>
	</div>

	<form>
	<div class="form-group">
		<label for="inputRole">Role</label>
		<input type="text" class="form-control" id="inputRole"
		name="role" placeholder="Role" value="{{$user->role}}"
		@can ('changeRole',$user)
		@else
		disabled
		@endcan
		>
	</div>

	<form>
	<div class="form-group">
		<label for="inputDescription">Brief description</label>
		<textarea class="form-control" id="inputDescription" name="description" style="resize:none"
		placeholder="description">{{$user->description}}</textarea>
	</div>

	<div class="form-group">
		<label for="inputPassword">Password</label>
		<input type="password" class="form-control" id="inputPassword" 
		name="password" placeholder="Password">
	</div>

	<div class="form-group">
		<label for="inputPasswordConfirm">Password Confirm</label>
		<input type="password" class="form-control" id="inputPasswordConfirm" 
		name="password_confirmation" placeholder="Password Confirm">
	</div>

	<button type="submit" class="btn btn-default">Submit</button>
	</form>
</div>
</div>
</div>
@endsection

