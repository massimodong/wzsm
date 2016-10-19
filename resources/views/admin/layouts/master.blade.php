<html>
<head>
<title>Admin - @yield('title')</title>
</head>
<body>
@section('sidebar')
	<p><a href='/'>Home</a><p>
	<p><a href='/admin/users'>Users</a><p>
	<p><a href='/admin/articles'>Articles</a><p>
@show

<p>######################</p>

<div class="container">
@yield('content')
</div>
</body>
</html>
