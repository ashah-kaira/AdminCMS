<?php
use Infrastructure\Common;
use \Infrastructure\Constants;
use \ViewModels\SessionHelper;
$loginUser =Auth::user();
$loginRoleID =$loginUser?$loginUser->RoleID:0;
?>
@extends((( !$loginRoleID || $loginRoleID== \Infrastructure\Constants::$RoleStudent) ? 'layouts.front_sitemaster' : 'layouts.sitemaster'))
@section('Title', ' Not Found ')
@section('content')
     <!-- Begin page content -->
	<main id="main" role="main" style="display:none;">
        <?php if(!$loginUser || $loginRoleID == Constants::$RoleStudent){?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 no-padding page-section-title">
                    <img class="img-responsive" src="<?php echo asset('/assets/images/login_banner.png'); ?>" />
                    <div class="page-title">
                        <h1>Page Not Found</h1>
                    </div>
                </div>
            </div>
            <div class="row  page-content-notfound">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="error-container">
                                <h1>Oops!</h1>
                                <h2>404 Not Found</h2>
                                <div class="error-details">
                                    Sorry, the page you're looking for isn't here.
                                </div>
                            </div> <!-- /.error-container -->
                        </div> <!-- /.span12 -->
                    </div> <!-- /.row -->
                </div>
            </div>
        <?php }else{?>
            <header class="heading-area">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                    <ul class="breadcrumb">
                        <li><a href="#">Page Not Found</a></li>
                    </ul>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="error-container">
                            <h1>Oops!</h1>
                            <h2>404 Not Found</h2>
                            <div class="error-details">
                                Sorry, the page you're looking for isn't here.
                            </div>
                        </div> <!-- /.error-container -->
                    </div> <!-- /.span12 -->
                </div> <!-- /.row -->
            </div>
        <?php } ?>
	 <!-- End page content -->
    </main>

 @stop
@section('script')
<script type="text/javascript">
	$(document).ready(function () {
		$("#main").show();
	});
</script>
@stop