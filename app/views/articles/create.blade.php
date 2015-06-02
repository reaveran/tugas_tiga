@extends("layouts.application")
@section("content")
@if (Session::has('notice'))
  <div class="alert alert-danger">
      {{Session::get('notice')}}
  </div>
@endif
<h2>Create New Article</h2>
<h3 style="text-align:center">Import file</h3>
<p style="text-align:center">format file excel. Total 3 column with first row 'title' , 'content', 'author'</p>
{{ Form::open(array('url' => 'articles/import', 'class' => 'form-horizontal', 'files' => true , 'method' => 'post', 'role' => 'form')) }}
    <div class="form-group">
      {{Form::label('file', 'File', array('class' => 'col-lg-3 control-label'))}}
      <div class="col-lg-6">
        {{Form::file('file','',array('class' => 'form-control', 'autofocus' => 'true'))}}
        {{$errors->first('upload')}}
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
{{ Form::close() }}
<hr>
<h3 style="text-align:center">or Insert article with form</h3>
{{Form::open(array('url' => 'articles', 'class' => 'form-horizontal', 'role' => 'form'))}}
  	<div class="form-group">
 		{{Form::label('title', 'Title', array('class' => 'col-lg-3 control-label'))}}
    	<div class="col-lg-7">
      		{{Form::text('title', null, array('class' => 'form-control', 'autofocus' => 'true'))}}
      		{{$errors->first('title')}}
    	</div>
    	<div class="clear"></div>
  	</div>

  	<div class="form-group">
    	{{Form::label('content', 'Content', array('class' => 'col-lg-3 control-label'))}}
    	<div class="col-lg-7">
      		{{Form::textarea('content', null, array('class' => 'form-control', 'rows' => 10))}}
      		{{$errors->first('content')}}
    	</div>
    	<div class="clear"></div>
  	</div>
  	<div class="form-group">
    	{{Form::label('author', 'Writer', array('class' => 'col-lg-3 control-label'))}}
    	<div class="col-lg-7">
    	  	{{Form::text('author', null, array('class' => 'form-control'))}}
      		{{$errors->first('author')}}
    	</div>
    	<div class="clear"></div>
  	</div>
  	<div class="form-group">
    	<div class="col-lg-3"></div>
    	<div class="col-lg-7">
      		{{Form::submit('Save', array('class' => 'btn btn-primary'))}}
    	</div>
    	<div class="clear"></div>
  	</div>
{{Form::close()}}
@stop