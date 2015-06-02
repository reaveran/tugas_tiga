@extends("layouts.application")
@section("content")
@if (Session::has('notice'))
    <div class="alert alert-info">{{Session::get('notice')}}</div>
@endif
	<div class="row">
		<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
			
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			{{ Form::open(array('url' => 'articles/download', 'class' => '', 'files' => true , 'method' => 'post', 'role' => 'form')) }}
	    	{{Form::hidden('id', $article->id, array('class' => '', 'autofocus' => 'true'))}}
	      	{{Form::submit('Download Article as .xls', array('class' => 'btn btn-primary'))}}
	      	<div class="clear"></div>
			{{ Form::close() }}
		</div>
		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
			{{ Form::open(array('url' => 'articles/download2', 'class' => '', 'files' => true , 'method' => 'post', 'role' => 'form')) }}
	    	{{Form::hidden('id', $article->id, array('class' => '', 'autofocus' => 'true'))}}
	      	{{Form::submit('Download Article as .pdf', array('class' => 'btn btn-primary'))}}
	      	<div class="clear"></div>
			{{ Form::close() }}
		</div>
		
	</div>
	<div class="row">
	    <h1>{{$article->title}}</h1>
	    <p>{{$article->content}}</p>
	    <i>By {{$article->author}}</i>
	</div>
	<hr>
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<!-- comment -->
			<h5><i><u>Give Comments</u></i></h5>
		    {{Form::open(array('url' => 'comments', 'class' => 'form-horizontal', 'role' => 'form'))}}
		    <div class="form-group">
		      	{{Form::label('article_id', 'Title', array('class' => 'col-lg-3 control-label'))}}
		      	<div class="col-lg-9">
		    		{{Form::text('article_id', $value = $article->id, array('class' => 'form-control', 'readonly'))}}
		      	</div>
		      	<div class="clear"></div>
		    </div>
		    <div class="form-group">
				{{Form::label('content', 'Content', array('class' => 'col-lg-3 control-label'))}}
				<div class="col-lg-9">
					{{Form::textarea('content', null, array('class' => 'form-control', 'rows' => 5, 'autofocus' => 'true'))}}
					{{$errors->first('content')}}
				</div>
				<div class="clear"></div>
			</div>
		    <div class="form-group">
		      	{{Form::label('user', 'User', array('class' => 'col-lg-3 control-label'))}}
		      	<div class="col-lg-9">
		        	{{Form::text('user', null, array('class' => 'form-control'))}}
		        	{{$errors->first('user')}}
		     	</div>
		      	<div class="clear"></div>
		    </div>
		    <div class="form-group">
					<div class="col-lg-3"></div>
					<div class="col-lg-9">
					{{Form::submit('Save', array('class' => 'btn btn-primary'))}}
					</div>
					<div class="clear"></div>
				</div>
			{{Form::close()}}
		</div>
	</div>
	<hr>
	<div class="row">
	<br>
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="border-bottom:1px solid #DDDDD9">
				<b>comment : </b>
			</div>
		</div>
		@foreach(Article::find($article->id)->comments as $comment)
			<div class="row">
			    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="border-bottom:1px solid #DDDDD9">
			    	<i style="color:blue">{{$comment->user}}</i>
			    	<p>{{$comment->content}}</p>
			    </div>	
			</div>
			<br>
	  	@endforeach
	</div>
@stop