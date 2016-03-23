<?php
use Infrastructure\Constants;
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<html  lang="en" ng-app="App">

<head>
    <title><?php echo Constants::$projectNameTitle;?>@yield('Title')</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />

    <link href="<?php echo asset('/assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type='text/css'>
    <!--For Icons in Menu -->
    <link href="<?php echo asset('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/msgbox/msgGrowl.css');?>" rel="stylesheet" type='text/css'>
    <!-- END GLOBAL MANDATORY STYLES -->

    !-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo asset('/assets/global/css/components-md.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo asset('/assets/global/css/plugins-md.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?php echo asset('/assets/layouts/layout/css/layout.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/layouts/layout/css/themes/default.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/layouts/layout/css/custom.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/custom.css');?>" rel="stylesheet" type='text/css'>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>

    @yield('css')

</head>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">

<!--<div class="windowloader">
    <div class="loaderimage">
    </div>
</div>-->
<span data-us-spinner="{radius:30, width:8, length: 16,scale:0.5}"></span>


<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="#">
                <img src="<?php echo asset('/assets/layouts/layout/img/logo.png'); ?>" alt="logo" class="logo-default" /> </a>
        </div>
        <!-- END LOGO -->

        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <!--<img alt="" class="img-circle" src="<?php echo asset('/assets/layouts/layout/img/avatar3_small.jpg'); ?>" />-->
                        <span class="username username-hide-on-mobile">{{ @Auth::User()->FirstName }}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="#">
                                <i class="icon-user"></i> My Profile </a>
                        </li>

                        <!--<li class="divider"> </li>-->

                        <li>
                            <a href="<?php echo URL::to('/').'/logout'; ?>">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="">
        @yield('content')
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"><?php echo Constants::$footerText;?>
        <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->

<script type="text/javascript">
    window.baseUrl = "<?php echo URL::to('/')?>";
</script>

<!--[if lt IE 9]>
<script src="<?php echo asset('/assets/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo asset('/assets/global/plugins/excanvas.min.js'); ?>"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo asset('/assets/global/plugins/jquery.min.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/bootstrap/js/bootstrap.min.js');?>"></script>

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo asset('/assets/global/scripts/global_app.min.js');?>"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo asset('/assets/layouts/layout/scripts/layout.min.js');?>"></script>
<script src="<?php echo asset('/assets/layouts/layout/scripts/demo.min.js');?>"></script>
<script src="<?php echo asset('/assets/layouts/global/scripts/quick-sidebar.min.js');?>"></script>

<!-- END THEME LAYOUT SCRIPTS -->

<script src="<?php echo asset('/assets/js/jquery.cookie.js');?>"></script>
<script src="<?php echo asset('/assets/js/moment.js');?>"></script>
<script src="<?php echo asset('/assets/js/datetimepicker/bootstrap-datetimepicker.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/jquery.blockui.min.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/uniform/jquery.uniform.min.js');?>"></script>
<script src="<?php echo asset('/assets/js/pagerjs/msgbox/msgGrowl.js');?>"></script>

<!-- Angular -->
<script src="<?php echo asset('/assets/js/angularjs/angular.min.js');?>"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-messages.js"></script>-->
<script src="<?php echo asset('/assets/js/dirPagination.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/app.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/angular-loading-spinner.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/angular-spinner.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/spin.js');?>"></script>
<!-- End Angular -->
<script src="<?php echo asset('/assets/js/BootstrapDialogJs/bootstrap-dialog.js');?>"></script>
<script src="<?php echo asset('/assets/js/common.js');?>"></script>
<script src="<?php echo asset('/assets/js/directive.js');?>"></script>


<!-- END CORE PLUGINS -->

<script type="text/javascript">
    window.ConfirmDialogTitle ="{{ trans('messages.ConfirmDialogTitle')}}";
    window.Confirmdialogmessage ="{{ trans('messages.Confirmdialogmessage')}}";
    window.ConfirmDialogSomethingWrong ="{{ trans('messages.ConfirmDialogSomethingWrong')}}";
    window.PageSize = "<?php echo Constants::$UserPagerSize; ?>";
</script>

@yield('script')

</body>
</html>
