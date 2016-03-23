<?php
    use Infrastructure\Constants; // For get value of Pagination PageSize and set per page records from server side when page load
?>
<html ng-app="App">
<head>
    <title>@yield('Title')</title>

    <link href="<?php echo asset('/assets/css/bootstrap.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/style.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/custom.css');?>" rel="stylesheet" type='text/css'>

    <link href="<?php echo asset('/assets/css/datetimepicker/bootstrap-datetimepicker.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/datetimepicker/bootstrap-datetimepicker-standalone.css');?>" rel="stylesheet" type='text/css'>

    <link href="<?php echo asset('/assets/css/style-responsive.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/msgbox/msgGrowl.css');?>" rel="stylesheet" type='text/css'>
</head>

<body>

<section id="container" >

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <!-- Begin page content -->

            @yield('content')

            <!-- End page content -->

        </section>
    </section>

</section>

<script type="text/javascript">
    window.baseUrl = "<?php echo URL::to('/')?>";
</script>
<script src="<?php echo asset('/assets/js/jquery.js');?>"></script>
<script src="<?php echo asset('/assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/angular.min.js');?>"></script>

<script src="<?php echo asset('/assets/js/angularjs/jquery.validate.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/jquery.validate.unobtrusive.js');?>"></script>

<script src="<?php echo asset('/assets/js/BootstrapDialogJs/bootstrap-dialog.js');?>"></script>
<script src="<?php echo asset('/assets/js/pagerjs/msgbox/msgGrowl.js');?>"></script>
<script src="<?php echo asset('/assets/js/jquery.cookie.js');?>"></script>
<script src="<?php echo asset('/assets/js/moment.js');?>"></script>
<script src="<?php echo asset('/assets/js/datetimepicker/bootstrap-datetimepicker.js');?>"></script>
<script src="<?php echo asset('/assets/js/dirPagination.js');?>"></script>
<script src="<?php echo asset('/assets/js/angularjs/app.js');?>"></script>
<script src="<?php echo asset('/assets/js/common.js');?>"></script>

<script>
    $(document).ready(function(){
        $(window).load(function(){
            $("#main").show();
        });
    });
</script>


<script type="text/javascript">
    window.ConfirmDialogTitle ="{{ trans('messages.ConfirmDialogTitle')}}";
    window.Confirmdialogmessage ="{{ trans('messages.Confirmdialogmessage')}}";
    window.ConfirmDialogSomethingWrong ="{{ trans('messages.ConfirmDialogSomethingWrong')}}";

    window.PageSize = "<?php echo Constants::$UserPagerSize; ?>"; // For set default value of pagination per page record and PageSize when page load getting value from server side

</script>

@yield('script')

</body>
</html>
