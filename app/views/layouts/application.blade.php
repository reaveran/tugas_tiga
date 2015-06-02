<!DOCTYPE html>
<html>
    <head>
      	<meta charset="utf-8">
	    <meta httpequiv="XUACompatible" content="IE=edge">
		<meta name="viewport" content="width=devicewidth, initialscale=1">
		<title>Article</title>
	    <?= stylesheetLinkTag() ?>
	    <?= javascript_include_tag() ?>
    </head>
    <body style="padding-top:60px;">
      <!--bagian navigation-->
      @include('shared.head_nav')
      <!-- Bagian Content -->
      	<div class="container clearfix">
	        <div class="container">
	        	@yield("content")
	        </div>   
      	</div>
    </body>
</html>