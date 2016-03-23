<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=1180">
<meta name="MobileOptimized" content="1180"> 
<title>DCC </title>
<link rel="icon" href="<?php echo asset('/assets/images/favicon.ico');?>" type="image/x-icon" />
<link rel="stylesheet" href="<?php echo asset('/assets/css/bootstrap.css');?>">
<link rel="stylesheet" href="<?php echo asset('/assets/css/site.css');?>">
<link rel="stylesheet" href="<?php echo asset('/assets/css/all.css');?>">
<link rel="stylesheet" href="<?php echo asset('/assets/css/fontawesome.css');?>">
<link rel="stylesheet" href="<?php echo asset('/assets/css/toaster/toaster.css');?>">
<link rel="stylesheet" href="<?php echo asset('/assets/css/multiple-select.css');?>">
<link rel="stylesheet" href="<?php echo asset('/assets/css/bootstrap-datepicker.css');?>">
<link rel="stylesheet" href="<?php echo asset('/assets/css/bootstrap-timepicker.css');?>" />
<link rel="stylesheet" href="<?php echo asset('/assets/css/sitecss/black/css/jquery.msgbox.css');?>" />

</head>
<body>
 <div id="wrapper">
	<div class="container">
		<div class="row">
			<header id="header">
			
				<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
					<div class="logo"> <a href="<?php echo URL::to('/')?>"><img src="<?php echo asset('/assets/images/logo.png');?>" alt="DickinsonCameron"></a> </div>
				</div>
				
			</header>			
		

     <!-- Begin page content -->
		 
       		<main id="main" role="main">
				<header class="heading-area">
					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
						<ul class="breadcrumb">
							<li><a href="#">Internal Server Error</a></li>
						</ul>
					</div>
					
				</header>
				<div class="container" style="min-height: 500px;">
					<div class="row">
						<div class="col-lg-12">
							<h1 align="center">Sorry, The server encountered an internal error or misconfiguration and was unable to complit your request.
</h1>
						</div>
					</div>
				</div>
		   </main>
       		
    	
	 <!-- End page content -->

     <footer id="footer">
				<span class="copyright">&copy; <?php echo date('Y'); ?> <a href="http://www.dickinsoncameron.com" target="_blank">Dickinson Cameron</a>, Inc. All Rights.</span>
				<ul class="links">
					<li><a href="#">Subscribe to Calendar</a></li>
					<li><a href="#">Help &amp; Support</a></li>
				</ul>
				<span class="powered">V1.0 &#149; Powered by <a href="http://lithyem.net" target="_blank">Lithyem</a></span>
			</footer>
		</main>
		</div>
	</div>
</div>	
	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	 <script>window.baseUrl = "<?php echo URL::to('/')?>"</script>
	 <script src="<?php echo asset('/assets/js/jquery-1.11.2.min.js');?>"></script> 
	 <script src="<?php echo asset('/assets/js/bootstrap.min.js');?>"></script>
	 <script src="<?php echo asset('/assets/js/ie10-viewport-bug-workaround.js');?>"></script>	
	<script src="<?php echo asset('/assets/js/PageLibraries/jquery.msgbox.js');?>"></script>
    <script src="<?php echo asset('/assets/js/PageLibraries/jquery.history.js');?>"></script>
	<script src="<?php echo asset('/assets/js/PageLibraries/knockout-2.1.0.js');?>"></script>
	<script src="<?php echo asset('/assets/js/PageLibraries/knockout.mapping.js');?>"></script>
	<script src="<?php echo asset('/assets/js/PageLibraries/knockout.validation.js');?>"></script>
	<script src="<?php echo asset('/assets/js/toaster/toaster.js');?>"></script>
	<script src="<?php echo asset('/assets/js/jquery.cookie.js');?>"></script>
	<script src="<?php echo asset('/assets/js/pagejs/common.js');?>"></script>
    <script src="<?php echo asset('/assets/js/BootstrapDialogJs/bootstrap-dialog.js');?>"></script>
    <script type="text/javascript">
	if (navigator.userAgent.match(/IEMobile\/10\.0/) || navigator.userAgent.match(/MSIE 10.*Touch/)) {
		var msViewportStyle = document.createElement('style')
		msViewportStyle.appendChild(
		document.createTextNode(
		 '@-ms-viewport{width:1180px !important}'
		)
		)
		document.querySelector('head').appendChild(msViewportStyle)
	}
	</script>
	 <script type="text/javascript">
 $(document).ready(function () {
	 $("#main").show();
	    
	});
</script> 
<script type="text/javascript">

/* window.history.forward();
        function noBack()
        {
            window.history.forward();
        }
 */
</script>
	@yield('script')
</body>
</html>

