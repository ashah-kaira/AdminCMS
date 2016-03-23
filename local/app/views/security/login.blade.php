@extends('layouts.loginmaster')
@section('Title','login')
@stop
@section('content')
    <form class="login-form" name="loginForm"  novalidate>
        <div class="form-body" ng-controller = "SecurityController" ng-cloak>
        <h3 class="form-title font-green">Sign In</h3>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control" type="email" maxlength="50" placeholder="Email" name="Email"  ng-model="LoginModel.Email" pattern="<?php echo \Infrastructure\Constants::$emailRegex?>" ng-class="{ 'has-submitted' : loginForm.$submitted}" required />
            <span class="error-text-color" ng-show="loginForm.$submitted">
                    <span ng-show="loginForm.Email.$error.required">{{ trans('messages.PropertyRequired',array('attribute'=>'Email'))}}</span>
                    <span ng-show="loginForm.Email.$error.pattern">{{ trans('messages.InvalidEmail')}}</span>
	         </span>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password"  placeholder="Password" name="Password"  ng-model="LoginModel.Password" ng-class="{ 'has-submitted' : loginForm.$submitted}" required />
            <span class="error-text-color" ng-show="loginForm.$submitted">
                    <span ng-show="loginForm.Password.$error.required">{{ trans('messages.PropertyRequired',array('attribute'=>'Password'))}}</span>
	         </span>
        </div>

         <div class="form-actions">
                <button type="submit" class="btn green uppercase" data-ng-click="Login()">Login</button>
                <a  id="forget-password" class="forget-password" href="<?php echo URL::to('/').'/sendforgotpassword'; ?>">Forgot Password?</a>
         </div>

          <span ng-if="LoginModel.IsPending">Sorry, your account has not been yet activated, please click <a ng-click="SendVerificationEmail(LoginModel)">here</a > to re-send a verification email.</span>
          <span ng-if="LoginModel.IsPendingSuccess">We have sent a verification email, please follow instructions in the email to activate your account.</span>

       </div>
    </form>
@stop

@section('script')
    <script src="<?php echo asset('/assets/js/pagerjs/security/login.js');?>"></script>
@stop