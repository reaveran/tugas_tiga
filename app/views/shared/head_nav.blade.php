<div class="navbar navbar-fixed-top navbar-default" role="navigation" >
  <div class="container">
    <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"/>
	        <span class="icon-bar"/>
	    </button>
	    <a href="#" class = "navbar-brand">Relatiohship and CRUD</a>
    </div>
    <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
	    <li>{{link_to('articles', 'Home', array('class' => 'list-group-item2'))}}</li>
	    <li>{{link_to('articles/create', 'Create Article', array('class' => 'list-group-item2'))}}</li>
    </ul>
    </div>
  </div>
</div>