@extends('layouts.master')

@section('title', 'login')


@section('content')
<div class="container">
<form class="form-signin" method="POST" action="/auth/login">
{!! csrf_field() !!}

<h2 class="form-signin-heading">Please sign in</h2>

<label for="inputEmail" class="sr-only">Email address</label>
<input type="email" id="inputEmail" class="form-control" placeholder="Email Address" name="email" value="{{ old('email') }}" required autofocus>

<label for="inputPassword" class="sr-only">Password</label>
<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

<div class="checkbox">
<label>
<input type="checkbox" name="remember"> Remember Me
</label>
</div>

<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

<div>
<a href='/password/email'>forgot password?</a><br>
</div>

</form>
</div>
@endsection
