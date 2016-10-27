@extends('layouts.master')
@section('title')
{{trans('wzsm.register')}}
@endsection

@section('content')
<form class="form-register" method="POST" action="/auth/register">
{!! csrf_field() !!}

<h2 class="form-register-heading">{{trans('wzsm.register')}}</h2>

<label for="inputName" class="sr-only">{{trans('wzsm.name')}}</label>
<input type="text" id="inputName" class="form-control" placeholder="{{trans('wzsm.name')}}" name="name" value="{{old('name')}}" required autofocus>

<label for="inputEmail" class="sr-only">{{trans('wzsm.email')}}</label>
<input type="email" id="inputEmail" class="form-control" placeholder="{{trans('wzsm.email')}}" name="email" value="{{old('email')}}" required>

<label for="inputPassword" class="sr-only">{{trans('wzsm.password')}}</label>
<input type="password" id="inputPassword" class="form-control" placeholder="{{trans('wzsm.password')}}" name="password" required>

<label for="inputPasswordConfirm" class="sr-only">{{trans('wzsm.password_confirm')}}</label>
<input type="password" id="inputPasswordConfirm" class="form-control" placeholder="{{trans('wzsm.password_confirm')}}" name="password_confirmation" required>

<label for="inputCaptcha" class="sr-only">{{trans('wzsm.captcha')}}</label>
<input type="text" id="inputCaptcha" class="form-control" placeholder="{{trans('wzsm.captcha')}}" name="captcha" required>

<img src="{{captcha_src('flat')}}">

<button type="submit" class="btn btn-lg btn-primary btn-block">{{trans('wzsm.register')}}</button>
</form>
@endsection
