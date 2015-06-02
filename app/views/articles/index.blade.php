@extends("layouts.application")
@section("content")

@if (Session::has('notice'))
    <div class="alert alert-info">{{Session::get('notice')}}</div>
@endif
<?php
	{{$articles = Article::paginate(10);}}
?>
<div class="row">
@foreach ($articles as $article)
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	<h2>{{$article->title}}</h2>
    <p>{{ str_limit($article->content, $limit = 200, $end = '...') }}</p>
    <i>By {{$article->author}}</i>
    <div class="row">
    	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    		<div class="row">
    			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		    		{{link_to('articles/'.$article->id, 'Show', array('class' => 'btn btn-info'))}}
		    	</div>	
		    	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		    		{{link_to('articles/'.$article->id.'/edit', 'Edit', array('class' => 'btn btn-warning'))}}
		    	</div>
		    	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		    		{{ Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete')) }}
		        	{{ Form::submit('Delete', array('class' => 'btn btn-danger', "onclick" => "return confirm('are you sure?')")) }}
		      	{{ Form::close() }}
		    	</div>
		    </div>
    	</div>
	</div>	
</div>
@endforeach
</div>
<?php echo $articles->links(); ?>
@stop