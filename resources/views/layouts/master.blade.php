<html>
<head>
<title>Wzsm - @yield('title')</title>
</head>
<body>
@section('sidebar')
	@if (Auth::check())
		<p>Current User: {{Auth::user()->name}} <br /> 
		<a href='auth/logout'>logout</a><p>
	@else
		<p><a href='auth/login'>login</a></p>
	@endif
@show

<div class="container">
@yield('content')
</div>
</body>
</html>
