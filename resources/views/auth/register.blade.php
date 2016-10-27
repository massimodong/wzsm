@extends('layouts.master')
@section('title', 'register')

@section('content')
<form class="form-register" method="POST" action="/auth/register">
{!! csrf_field() !!}

<h2 class="form-register-heading">Register</h2>

<label for="inputName" class="sr-only">Name</label>
<input type="text" id="inputName" class="form-control" placeholder="Name" name="name" value="{{old('name')}}" required autofocus>

<label for="inputEmail" class="sr-only">Email</label>
<input type="email" id="inputEmail" class="form-control" placeholder="Email Address" name="email" value="{{old('email')}}" required>

<label for="inputPassword" class="sr-only">Password</label>
<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

<label for="inputPasswordConfirm" class="sr-only">Password Confirm</label>
<input type="password" id="inputPasswordConfirm" class="form-control" placeholder="Password Confirm" name="password_confirmation" required>

<label for="inputCaptcha" class="sr-only">Captcha</label>
<input type="text" id="inputCaptcha" class="form-control" placeholder="captcha" name="captcha" required>

<img src="{{captcha_src('flat')}}">

<button type="submit" class="btn btn-lg btn-primary btn-block">Register</button>
</form>
@endsection
