@extends('layouts.master')

@section('title')
{{trans('wzsm.about')}}
@endsection

@section('content')
<div class='container'>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">WZSM <small> 我们不只是节奏的发起人 </small></h1>
			<p>贴吧太大，你是否厌倦了满屏的水贴？</p>
			<p>班群太小，你是否抱怨没有发挥的空间？</p>
			<p>wzsm，或许将成为你的选择。 </p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">1. 怎样使用本网站 </h2>
			<p>轻点“新文章”，说出你的故事；轻按“发送”，传递你的心声：图标＋说明。</p>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">2. 我们是谁 </h2>
			<div class="row">
				<div class="col-lg-3">
					<p><img class="img-responsive img-rounded" src="/include/img/hal.png">
				</div>
				<div class="col-lg-4">
					<br>
					Have A Look,<br>
					你也可以选择加入我们。<br>
				</div>
			</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<h2 class="page-header">3. 注意事项 </h2>
			<p>&middot; <strike>因为懒</strike>为了鼓励使用真实邮箱注册，我们的头像由<a href="http://cn.gravatar.com/" target="_blank">Gravatar</a>提供，你可以用你的注册邮箱创建一个Gravatar头像，这样就可以在我们的页面显示了！</p>
			<p>&middot; 对于普通用户，所有新发布的文章都需要审核，但是审核成功后可以随意修改。请不要恶意操作。</p>
			<p>&middot; 新建文章时请给你的文章撰写简介并配置标题图片。如果留空，我们将在审核时帮你完成</p>
			<p>&middot; 我们欢迎各抒己见，和谐讨论，但我们拒绝偏激泄愤，对骂互喷。</p>
		</div>
	</div>
</div>

@endsection


@section('scripts')
<script>document.getElementById('about_sidebar').className='active'</script>
@endsection
