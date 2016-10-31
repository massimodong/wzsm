@extends('layouts.master')

@section('title')
{{trans('wzsm.login')}}
@endsection

@section('head')
@parent
@include('layouts.forceHttps')

@endsection


@section('content')
<div class="container">
<form class="form-signin" method="POST" action="/auth/login">
{!! csrf_field() !!}

<h2 class="form-signin-heading">{{trans('wzsm.login')}}</h2>

<label for="inputEmail" class="sr-only">Email</label>
<input type="email" id="inputEmail" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus>

<label for="inputPassword" class="sr-only">Password</label>
<input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>

<div class="checkbox">
<label>
<input type="checkbox" name="remember">{{trans('wzsm.remember_me')}} 
</label>
</div>

<button class="btn btn-lg btn-primary btn-block" type="submit">{{trans('wzsm.login')}}</button>

<div>
<a href='/password/email'>{{trans('wzsm.forgot_password')}}?</a><br>
</div>

</form>
</div>
@endsection
