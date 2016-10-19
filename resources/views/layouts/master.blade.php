<html>
<head>
<title>Wzsm - @yield('title')</title>
</head>
<body>
@section('sidebar')
	<a href='/'>Home</a>
	@if (Auth::check())
		<p>Current User: {{Auth::user()->name}} <br /> 
		<form action='/articles' method='POST'>
			{{ csrf_field() }}
			<button type='submit' class='btn btn-default'>New article</button>
		</form>
		<a href='/auth/logout'>logout</a><p>
	@else
		<p><a href='/auth/login'>login</a></p>
	@endif
@show

<p>######################</p>

<div class="container">
@yield('content')
</div>
</body>
</html>
