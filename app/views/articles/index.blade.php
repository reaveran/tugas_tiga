@extends("layouts.application")
@section("content")

@if (Session::has('notice'))
    <div class="alert alert-info">{{Session::get('notice')}}</div>
@endif
<?php
	{{$articles = Article::paginate(10);}}
?>
<ul class="list-group">
@foreach ($articles as $article)
<li class="list-group-item">
	<h3>{{$article->title}}</h3>
    <p>{{ str_limit($article->content, $limit = 200, $end = '...') }}</p>
    by <span class="label label-info"> {{$article->author}}</span>
    <div class="row" style="margin-top:10px">
    	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    		<div class="row">
    			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		    		{{link_to('articles/'.$article->id, 'Show', array('class' => 'btn btn-primary', 'style' => 'width:70px;padding:4px'))}}
		    	</div>	
		    	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		    		{{link_to('articles/'.$article->id.'/edit', 'Edit', array('class' => 'btn btn-primary', 'style' => 'width:70px;padding:4px'))}}
		    	</div>
		    	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		    		{{ Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) }}
		        	{{ Form::submit('Delete', array('class' => 'btn btn-primary', 'style' => 'width:70px;padding:4px', "onclick" => "return confirm('are you sure?')")) }}
		      		{{ Form::close() }}
		    	</div>
		    </div>
    	</div>
	</div>	
</li>
@endforeach
</ul>
<?php echo $articles->links(); ?>
@stop