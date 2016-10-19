<html>
<head>
<title>Admin - @yield('title')</title>
</head>
<body>
@section('sidebar')
	<p><a href='/'>Home</a><p>
@show

<p>######################</p>

<div class="container">
@yield('content')
</div>
</body>
</html>
