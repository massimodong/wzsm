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
<form method="POST" action="/password/email">
	{!! csrf_field() !!}
	<div class="col-md-offset-4 col-md-4">

	<div class="form-group row">
		<div class="col-md-12">
			<label for="inputEmail">{{trans('wzsm.email')}}</label>
			<input type="email" class="form-control" id="inputEmail"
			name="email" placehold="{{trans('wzsm.email')}}" value="" required autofocus>
		</div>
	</div>
	
	<div class="row">
		<div class="form-group col-md-4">
			<label for="inputCaptcha">{{trans('wzsm.captcha')}}</label>
			<input type="text" class="form-control" id="inputCaptcha"
			name="captcha" placehold="{{trans('wzsm.captcha')}}" value="" required>
		</div>
		<div class="form-group col-md-8">
			<label for="captchaImage"></label><br>
			<img src="{{captcha_src()}}" id="captchaImage" alt="captcha"
			class="img-thumbnail" onclick="changeCaptcha()"></p>
		</div>
	</div>
	
	<div class=form-group>
		<button type="submit" class="form-control">Send Password Reset Link</button>
	</div>
	</form>

	</div>

</div>
</div>
</div>
@endsection
