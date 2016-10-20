<html>
<head>
<title>Wzsm - @yield('title')</title>
</head>
<body>
@section('sidebar')
	<a href='/'>Home</a>
	@if (Auth::check())
		<p>User: <a href='/users/{{Auth::user()->id}}'> {{Auth::user()->name}} </a><br /> 
		<form action='/articles' method='POST'>
			{{ csrf_field() }}
			<button type='submit' class='btn btn-default'>New article</button>
		</form>

		@if (Auth::user()->role === 'admin')
			<a href='/admin'>admin page</a><br/>
		@endif

		<a href='/auth/logout'>logout</a><p>
	@else
		<p><a href='/auth/login'>login</a></p>
	@endif
@show

@include ('common.errors')

<p>######################</p>

<div class="container">
@yield('content')
</div>
</body>
</html>
