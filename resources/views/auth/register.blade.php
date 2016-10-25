@extends('layouts.master')

@section('title', 'register')

@section('sidebar')
	@parent

@endsection

@section('content')
<form method="POST" action="/auth/register">
{!! csrf_field() !!}

<div>
Name
<input type="text" name="name" value="{{ old('name') }}">
</div>

<div>
Fullname
<input type="text" name="fullname" value="{{ old('fullname') }}">
</div>

<div>
Email
<input type="email" name="email" value="{{ old('email') }}">
</div>

<div>
Password
<input type="password" name="password">
</div>

<div>
Confirm Password
<input type="password" name="password_confirmation">
</div>

<div>
<p>Captcha
<input type="text" name="captcha">
{!!captcha_img()!!}</p>
</div>

<div>
<button type="submit">Register</button>
</div>
</form>
@endsection
