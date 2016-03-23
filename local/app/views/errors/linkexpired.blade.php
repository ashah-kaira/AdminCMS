<?php
$minify = new \CeesVanEgmond\Minify\Facades\Minify;
?>
@extends('layouts.front_sitemaster')
@section('Title', 'Reset Password')

@section('content')
<main id="main" role="main" class="displayhide">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 no-padding page-section-title">
            <img class="img-responsive" src="<?php echo asset('/assets/images/login_banner.png'); ?>" />
            <div class="page-title">
                <h1>Career Center</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 no-padding">
            <div class="page-content">
                <div id="login-section">
                    <h3>Reset Password</h3>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding  create-page">
                        <h1 align="center">Sorry, You have already used this Link</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@stop
@section('script')

@stop

