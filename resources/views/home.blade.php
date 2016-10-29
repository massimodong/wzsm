@extends('layouts.master')
@section('title')
{{trans('wzsm.home')}}
@endsection

@section('content')
<div class='container'>
	<div>
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
var LastTime='{{date("Y-m-d H:i:s",time()+1)}}';
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
		description='<p>{{trans('wzsm.need_description')}}</p>';
	}
	/*
	var html=`<div class="col-sm-4 col-lg-4 col-md-4">
		<div class="thumbnail">
			<div class="row">
				<div class="col-lg-12">
				 <a href="/articles/` + item.id + `"><img src="` + image + `" alt=""></a>
				 </div>
				 <div class="col-lg-12">
				 	<div class="" style="padding: 9px;min-height: 150px;">
					 <h4><a href="/articles/` + item.id + `">` + item.title + `</a>
					 </h4>
					`+ description +`</div>
				</div>
				<div class="col-lg-12">
				 <p class="pull-right" style="padding: 9px;">
				 <span class='glyphicon glyphicon-eye-open'></span> ` + item.views + 
				 `&emsp;<span class="glyphicon glyphicon-thumbs-up"></span> `+item.votes+`</p>
				 <p style="padding: 9px;">` + item.updated_at + `</p>
		 		</div>
			</div>
		 </div></div>
		`;
		*/
	var html = "<div class=\"col-sm-4 col-lg-4 col-md-4\">\n                <div class=\"thumbnail\">\n                        <div class=\"row\">\n                                <div class=\"col-lg-12\">\n                                 <a href=\"/articles/" + item.id + "\"><img src=\"" + image + "\" alt=\"\"></a>\n                                 </div>\n                                 <div class=\"col-lg-12\">\n                                        <div class=\"\" style=\"padding: 9px;min-height: 150px;\">\n                                         <h4><a href=\"/articles/" + item.id + "\">" + item.title + "</a>\n                                         </h4>\n                                        " + description + "</div>\n                                </div>\n                                <div class=\"col-lg-12\">\n                                 <p class=\"pull-right\" style=\"padding: 9px;\">\n                                 <span class='glyphicon glyphicon-eye-open'></span> " + item.views + "&emsp;<span class=\"glyphicon glyphicon-thumbs-up\"></span> " + item.votes + "</p>\n                                 <p style=\"padding: 9px;\">" + item.updated_at + "</p>\n                                </div>\n                        </div>\n                 </div></div>\n                ";
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
				$(articles_loader).append('<p>{{trans('wzsm.no_more_articles')}}</p>');
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
$(window).load(function(){Arts.forEach(addArticle);isExpanding=false;expand();})
$(window).scroll(function() {
	   if($(window).scrollTop() + $(window).height() >= $(document).height() - 500) {
	   	expand();
	   }
});
</script>

@endsection
