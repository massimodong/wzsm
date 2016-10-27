@extends('layouts.master')

@section('title')
{{$user->name}}
@endsection

@section('content')

<div class="container">
<div class="row">
	<div class="col-md-offset-1 col-md-12">
		<div class="well profile col-md-6 col-xs-12">
			<div class="col-sm-12">
				<div class="col-xs-12 col-sm-8">
					<h2>{{$user->fullname}}</h2>
					<p><strong>name:</strong>{{$user->name}}</p>
					<p><strong>role:</strong>{{$user->role}}</p>
					<p><strong>description:</strong>
					@if ($user->description == '')
						not any descriptions!
					@else
						{{$user->description}}
					@endif
					</p>
				</div>
				<div class="col-xs-12 col-sm-4 text-center">
					<figure>
						<img src="{{$user->gravatar()}}?s=180" alt="gravatar"
						class="img-responsive img-thumbnail">
					</figure>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-offset-1 col-md-12 col-lg-offset-1 col-lg-12">
		<div class="well profile col-md-6 col-xs-12">
			<div class="col-sm-12">
				<div class="col-xs-12 col-sm-12">
					<h3>articles:</h3>
					<div class="row">
					@foreach ($articles as $article)
						<div class="col-md-6 col-xs-12">
						<p><a href="/articles/{{$article->id}}">{{$article->title}}</a></p>
						</div>
						<div class="col-md-offset-1 col-md-3 col-xs-6">
						<p><span class="glyphicon glyphicon-thumbs-up"></span> {{$article->votes}}</p>
						</div>
						<div class="col-md-2 col-xs-6">
						@if ($article->top)
						<p class="pull-right">top</p>
						@endif
						</div>
					@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection

