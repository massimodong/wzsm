@extends('layouts.master')

@section('title')
{{trans('wzsm.reset_password')}}
@endsection

@section('head')
@parent
@include('layouts.forceHttps')
@endsection

@section('content')

<div class="container">
<div class="row">
<div class="col-md-12">
<form method="POST" action="/password/reset">
	{!! csrf_field() !!}
	<input type="hidden" name="token" value="{{ $token }}">

	<div class="col-md-offset-4 col-md-4">
	
	<div class="form-group">
		<label for="inputEmail">Email</label>
		<input type="email" class="form-control" id="inputEmail"
		name="email" placeholder="Email" value="" required autofocus>
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
</div>
@endsection
