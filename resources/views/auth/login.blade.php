@extends('layouts.master')

@section('title', 'login')

@section('sidebar')
	@parent

@endsection


@section('content')
<form method="POST" action="/auth/login">
{!! csrf_field() !!}

<div>
Email
<input type="email" name="email" value="{{ old('email') }}">
</div>

<div>
Password
<input type="password" name="password" id="password">
</div>

<div>
<input type="checkbox" name="remember"> Remember Me
</div>

<div>
<button type="submit">Login</button>
</div>

<div>
<a href='/auth/register'> register</a><br>
<a href='/password/email'>forgot password?</a><br>
</div>
</form>
@endsection
