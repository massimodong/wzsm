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
					<p><strong>{{trans('wzsm.name')}}:</strong>{{$user->name}}</p>
					<p><strong>{{trans('wzsm.role')}}:</strong>{{trans('wzsm.role_'.$user->role)}}</p>
					<p><strong>{{trans('wzsm.description')}}:</strong>
					@if ($user->description == '')
						{{trans('wzsm.no_descriptions')}}
					@else
						{{$user->description}}
					@endif
					</p>
					@can ('update',$user)
					<p><a href='/users/{{$user->id}}/edit'>{{trans('wzsm.edit')}}</a></p>
					@endcan
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
					<h3>{{trans('wzsm.his_articles')}}:</h3>
					@foreach ($articles as $article)
					<div class="row">
						<div class="col-md-4 col-xs-12">
						<p><a href="/articles/{{$article->id}}">
						@if ($article->title <> '')
						{{$article->title}}
						@else
						({{trans('wzsm.untitled')}})
						@endif
						</a></p>
						</div>
						<div class="col-md-offset-1 col-md-3 col-xs-6">
						<p><span class="glyphicon glyphicon-thumbs-up"></span> {{$article->votes}}</p>
						</div>
						<div class="col-md-4 col-xs-6">
							<p class="pull-right">
							[{{trans('wzsm.'.$article->status)}}]
							@if ($article->top)
							{{trans('wzsm.top')}}
							</p>
							@endif
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection

