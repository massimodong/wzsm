<!DOCTYPE html>
<html lang="en">
  <head>
  @section('head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>{{App\Option::option('site_name')->value}} | @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/vendor/bootstrap/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/include/css/common.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/vendor/bootstrap/docs/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @show
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/home">{{App\Option::option('site_name')->value}}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
	  @section('sidebar')
            <li id='home_sidebar'><a href="/home">
	    <span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li id='about_sidebar'><a href="/about">
	    <span class="glyphicon glyphicon-question-sign"></span> About</a></li>
	   @show
          </ul>
	  <ul class="nav navbar-nav navbar-right">
	    <li class="dropdown">
	            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		    @if (Auth::check())
		    <img src='{{Auth::user()->gravatar()}}?s=20' class="img-rounded" alt="avatar"> {{Auth::user()->name}}</a>
		    <ul class="dropdown-menu">
		    	<li><a href='#' onclick="document.forms['new_article_form'].submit(); return false;">
		       <span class="glyphicon glyphicon-pencil"></span> new article</a></li>
		    	<li><a href="/users/{{Auth::user()->id}}"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
			@if (Auth::user()->role === 'admin')
				<li><a href='/admin'><span class="glyphicon glyphicon-menu-hamburger"></span> Admin</a></li>
			@endif
		    	<li><a href="/auth/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		    </ul>
		    @else
		    Account
		    <span class="caret"></span></a>
		    <ul class="dropdown-menu">
		              <li><a href="/auth/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		              <li><a href="/auth/register"><span class="glyphicon glyphicon-user"></span> Register</a></li>
		    </ul>
		    @endif
            </li>
	  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


      	@yield('content')


    <form name='new_article_form' action='/articles' method='POST'>
    		{{ csrf_field() }}
    </form>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/vendor/bootstrap/docs/assets/js/vendor/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/vendor/bootstrap/docs/assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/vendor/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    @yield('scripts')
  </body>
</html>
