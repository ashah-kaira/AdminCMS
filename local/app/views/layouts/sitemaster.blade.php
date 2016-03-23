<?php
use Infrastructure\Constants; // For get value of Pagination PageSize and set per page records from server side when page load
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<html  lang="en" ng-app="App">

<head>
    <title>@yield('Title')</title>
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
            <div class="menu-toggler sidebar-toggler"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
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
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <li class="sidebar-toggler-wrapper hide">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <div class="sidebar-toggler"> </div>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
                </li>
                <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                <li class="sidebar-search-wrapper">
                    <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                    <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                    <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                    <form class="sidebar-search  " action="#" method="POST">
                        <a href="javascript:;" class="remove">
                            <i class="icon-close"></i>
                        </a>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn"> <!-- submit -->
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                        </div>
                    </form>
                    <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <li class="nav-item start active open">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">Choose Website</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start">
                    <a href="#" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="heading">
                    <h3 class="uppercase">CMS</h3>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">Manage Pages</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="#" class="nav-link ">
                                <span class="title">Page list</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="#" class="nav-link ">
                                <span class="title">Add Page</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Communities</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">Community list</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">Edit_Redstone</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">Developments</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">Development list</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="javascript:;" class="nav-link nav-toggle">
                                        <span class="title">Manage Development</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="nav-item  ">
                                            <a href="#" class="nav-link ">
                                                <span class="title">Add/Edit Development</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a href="#" class="nav-link ">
                                                <span class="title">CaseStudies</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a href="#" class="nav-link ">
                                                <span class="title">Videos</span>
                                            </a>
                                        </li>
                                        <li class="nav-item  ">
                                            <a href="#" class="nav-link ">
                                                <span class="title">Listings</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="#" class="nav-link ">
                                <span class="title">Loans Closed</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <span class="title">FAQs</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">FAQ list</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">Add/Edit FAQs</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="heading">
                    <h3 class="uppercase">Admin</h3>
                </li>
                <li class="nav-item  ">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-diamond"></i>
                        <span class="title">Manage Users</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  ">
                            <a href="<?php echo URL::to('/userlist'); ?>" class="nav-link ">
                                <span class="title">User list</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo URL::to('/add'); ?>" class="nav-link ">
                                <span class="title">Add/Edit User</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        @yield('content')
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2014 &copy; Metronic by keenthemes.
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
