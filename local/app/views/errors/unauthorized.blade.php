<?php
use Infrastructure\Common;
use \Infrastructure\Constants;
use \ViewModels\SessionHelper;
$loginUser =Auth::user();
$loginRoleID =$loginUser?$loginUser->RoleID:0;
?>
@extends(((!$loginRoleID || $loginRoleID== \Infrastructure\Constants::$RoleStudent) ? 'layouts.front_sitemaster' : 'layouts.sitemaster'))

@section('Title', ' Authorization Error ')
@section('content')
<main id="main" role="main">
<?php if($loginRoleID == Constants::$RoleStudent){?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 no-padding page-section-title">
            <img class="img-responsive" src="<?php echo asset('/assets/images/login_banner.png'); ?>" />
            <div class="page-title">
                <h1>Authorization Error</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 no-padding page-content">
            <div class="page-content-error">
                <div class="error-container">
                    <h1>Oops!</h1>
                    <h2>Authorization Error</h2>
                    <div class="error-details">
                        Sorry, You are trying to access a web page without proper authorization.
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }else{?>
    <header class="heading-area">
        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
            <ul class="breadcrumb">
                <li><a href="#">Authorization Error</a></li>
            </ul>
        </div>
    </header>
    <div class="container minHeightMainPage">
        <div class="row">
            <div class="col-lg-12">
                <div class="error-container">
                    <h1>Oops!</h1>
                    <h2>Authorization Error</h2>
                    <div class="error-details">
                        Sorry, You are trying to access a web page without proper authorization.
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</main>
@stop
