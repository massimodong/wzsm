@extends('layouts.master')
@section('title','Home')
@section('content')
<div class='container'>
	<div class='cold-md-9'>
		<div class="starter-template">
			<div class="row carousel-holder">
				<div class="jumbotron">
					<center><img src='/include/img/hal.png' class="img-responsive"  alt="HAL Logo"></center>
 			  		<h1>Have a look</h1> 
				</div>
			</div>
		</div>
		<div class='row' id='articles'>
		</div>
	</div>
	<center>
	<div class=loader id='articles_loader'></class>
	</center>
</div>
@endsection

@section('scripts')
<script>document.getElementById('home_sidebar').className='active'</script>

<script>
var LastTime='{{date("Y-m-d H:i:s"),time()+1}}';
var isExpanding=true;
var Arts={!!$articles->toJson()!!};
var shownArticles={};

function addArticle(item,index){

	if(shownArticles[item.id]){
		return;
	}
	shownArticles[item.id]=true;

	var image=item.image;
	if(image == ''){
		image='/include/img/hal.png'
	}

	var description=item.description;
	if(description == ''){
		description='<p>This article needs a description</p>';
	}
	var html=`<div class="col-sm-4 col-lg-4 col-md-4">
		<div class="thumbnail">
		 <img src="` + image + `" alt="">
		 <div class="caption">
		 <h5 class="pull-right">
		 <span class='glyphicon glyphicon-thumbs-up'></span> `+ item.votes +`<br/>
		 </h5>
		 <h4><a href="/articles/` + item.id + `">` + item.title + `</a>
		 </h4>
		`+ description +`</div>
		<div class="details">
		 <p class="pull-right"><span class='glyphicon glyphicon-eye-open'></span> ` + item.views + `</p>
		 <p>` + item.updated_at + `</p>
		 </div></div></div>
		`;
	$(articles).append(html);
}

function expand(){
	if(isExpanding){
		return;
	}
	isExpanding=true;

	var xhr;
	xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('get', '/ajax/articles?from='+LastTime);

	xhr.onload = function(){
		var json;
		if(xhr.status == 200){
			json = JSON.parse(xhr.responseText);
			json.forEach(addArticle);
			
			if(json.length == 0){
				$(articles_loader).attr('class','');
				$(articles_loader).append('<p>No more articles</p>');
				return;
			}

			LastTime = json[json.length-1].updated_at;
		}

		isExpanding = false;
	}

	xhr.send();
}
</script>

<script>
$(window).load(function(){Arts.forEach(addArticle);isExpanding=false;})
$(window).scroll(function() {
	   if($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
	   	expand();
	   }
});
</script>

@endsection
