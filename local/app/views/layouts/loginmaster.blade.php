<?php
use Infrastructure\Constants; // For get value of Pagination PageSize and set per page records from server side when page load
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" ng-app="App">
<!--<![endif]-->
<!-- BEGIN HEAD -->


<head>
    <meta charset="utf-8" />
    <title> <?Php echo Constants::$projectNameTitle;?> | User Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset('/assets/global/plugins/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type='text/css'>

    <link href="<?php echo asset('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/global/plugins/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/global/plugins/uniform/css/uniform.default.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset('/assets/css/msgbox/msgGrowl.css');?>" rel="stylesheet" type='text/css'>
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS
    <link href="<?php echo asset('/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet');?>" type="text/css" />
    <link href="<?php echo asset('/assets/global/plugins/select2/css/select2-bootstrap.min.css');?>" rel="stylesheet" type="text/css" />-->
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?php echo asset('/assets/global/css/components-md.min.css');?>" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?php echo asset('/assets/global/css/plugins-md.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <link href="<?php echo asset('/assets/css/custom.css');?>" rel="stylesheet" type='text/css'>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?php echo asset('/assets/pages/css/login.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class=" login">
<span data-us-spinner="{radius:30, width:8, length: 16,scale:0.5}"></span>
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="#">
        <img src="<?php echo asset('/assets/pages/img/logo-big.png'); ?>" alt="logo"/> </a>
</div>
<!-- END LOGO -->

<!-- BEGIN LOGIN -->
<div class="content page-content">
    <div>
    @yield('content')
    </div>
</div>

<div class="copyright"><?php echo Constants::$footerText;?></div>

<!--[if lt IE 9]>
<script src="<?php echo asset('/assets/global/plugins/respond.min.js'); ?>"></script>
<script src="<?php echo asset('/assets/global/plugins/excanvas.min.js'); ?>"></script>
<![endif]-->

<script type="text/javascript">
    window.baseUrl = "<?php echo URL::to('/')?>";
</script>

<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo asset('/assets/global/plugins/jquery.min.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/bootstrap/js/bootstrap.min.js');?>"></script>

<script src="<?php echo asset('/assets/js/jquery.cookie.js');?>"></script>
<script src="<?php echo asset('/assets/js/moment.js');?>"></script>

<script src="<?php echo asset('/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/jquery.blockui.min.js');?>"></script>
<script src="<?php echo asset('/assets/global/plugins/uniform/jquery.uniform.min.js');?>"></script>
<script src="<?php echo asset('/assets/js/pagerjs/msgbox/msgGrowl.js');?>"></script>

<!-- Angular -->
<script src="<?php echo asset('/assets/js/angularjs/angular.min.js');?>"></script>
<!--<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular-messages.js"></script>-->

<script src="<?php echo asset('/assets/js/angularjs/applogin.js');?>"></script>

<script src="<?php echo asset('/assets/js/angularjs/angular-loading-spinner.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/angular-spinner.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/spin.js');?>"></script>

<!-- End Angular -->
<script src="<?php echo asset('/assets/js/bootstrapdialogjs/bootstrap-dialog.js');?>"></script>
<script src="<?php echo asset('/assets/js/common.js');?>"></script>

<script type="text/javascript">
    window.ConfirmDialogTitle ="{{ trans('messages.ConfirmDialogTitle')}}";
    window.Confirmdialogmessage ="{{ trans('messages.Confirmdialogmessage')}}";
    window.ConfirmDialogSomethingWrong ="{{ trans('messages.ConfirmDialogSomethingWrong')}}";
    window.PageSize = "<?php echo Constants::$UserPagerSize; ?>";
</script>

@yield('script')
</body>
</html>