@extends('layouts.master')

@section('title')
{{trans('wzsm.edit')}} {{$user->name}}
@endsection

@section('content')

<div class="container">
<div class="row">
<div class="col-md-12">
	<form action="/users/{{$user->id}}/profile" method="POST">
	{{csrf_field()}}
	{{method_field('PUT')}}
	<div class="form-group">
		<label for="inputName">{{trans('wzsm.name')}}</label>
		<input type="text" class="form-control" id="inputName" 
		name="name" placeholder="{{trans('wzsm.name')}}" value="{{$user->name}}">
	</div>

	<div class="form-group">
		<label for="inputFullname">{{trans('wzsm.fullname')}}</label>
		<input type="text" class="form-control" id="inputFullname"
		name="fullname" placeholder="{{trans('wzsm.fullname')}}" value="{{$user->fullname}}">
	</div>

	<div class="form-group">
		<label for="inputEmail">Email</label>
		<input type="email" class="form-control" id="inputEmail"
		name="email" placeholder="Email" value="{{$user->email}}" disabled>
	</div>

	<div class="form-group">
		<label for="inputRole">{{trans('wzsm.role')}}</label>
		<input type="text" class="form-control" id="inputRole"
		name="role" placeholder="{{trans('wzsm.role')}}" value="{{$user->role}}"
		@can ('changeRole',$user)
		@else
		disabled
		@endcan
		>
	</div>

	<div class="form-group">
		<label for="inputDescription">{{trans('wzsm.user_description')}}</label>
		<textarea class="form-control" id="inputDescription" name="description" style="resize:none"
		placeholder="{{trans('wzsm.user_description_hint')}}">{{$user->description}}</textarea>
	</div>

	<div class="form-group">
		<label for="inputPassword">{{trans('wzsm.password')}}</label>
		<input type="password" class="form-control" id="inputPassword" 
		name="password" placeholder="{{trans('wzsm.password')}}">
	</div>

	<div class="form-group">
		<label for="inputPasswordConfirm">{{trans('wzsm.password_confirm')}}</label>
		<input type="password" class="form-control" id="inputPasswordConfirm" 
		name="password_confirmation" placeholder="{{trans('wzsm.password_confirm')}}">
	</div>

	<button type="submit" class="btn btn-default">{{trans('wzsm.submit')}}</button>
	</form>
</div>
</div>
</div>
@endsection

