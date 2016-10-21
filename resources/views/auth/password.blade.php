<form method="POST" action="/password/email">
{!! csrf_field() !!}

@if (count($errors) > 0)
	<ul>
@foreach ($errors->all() as $error)
	<li>{{ $error }}</li>
@endforeach
	</ul>
@endif

<div>
Email
<input type="email" name="email" value="{{ old('email') }}">
</div>

<div>
<p>Captcha
<input type="text" name="captcha">
{!!captcha_img()!!}</p>
</div>

<div>
<button type="submit">
Send Password Reset Link
</button>
</div>
</form>
