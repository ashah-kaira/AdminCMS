@extends('layouts.loginmaster')
@section('Title','login')

@stop
@section('css')
@stop

@section('content')
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="login-form" name="loginForm"  novalidate>
        <div class="form-body" ng-controller = "SecurityController" ng-cloak>
            <h3 class="form-title font-green">Forgot Password ?</h3>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <input class="form-control" type="email"  placeholder="Email" name="Email"  ng-model="LoginModel.Email" pattern="<?php echo \Infrastructure\Constants::$emailRegex?>" ng-class="{ 'has-submitted' : loginForm.$submitted}" required />
            <span class="error-text-color" ng-show="loginForm.$submitted">
                    <span ng-show="loginForm.Email.$error.required">{{ trans('messages.PropertyRequired',array('attribute'=>'Email'))}}</span>
                    <span ng-show="loginForm.Email.$error.pattern">{{ trans('messages.InvalidEmail')}}</span>
	         </span>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn green uppercase" data-ng-click="Login()">Request Password Reset</button>
            </div>

        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
@stop

@section('script')
    <script src="<?php echo asset('/assets/js/pagerjs/security/login.js');?>"></script>
@stop