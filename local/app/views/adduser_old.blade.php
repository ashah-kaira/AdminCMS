@extends('layouts.sitemaster')
@section('Title')
    <?php isset($UserModel->UserDetail->UserID) ? print 'Edit User' : print 'Add User';?>
@stop

@section('content')
<main id="main" role="main">
<?php echo Form::hidden('UserModel', json_encode($UserModel),$attributes = array('id'=>'UserModel')); ?>

<form name="RegistrationForm" id="RegistrationForm" class="form-horizontal" role="form" novalidate>

    <div ng-controller = "UserController" ng-cloak>
        <div class="form-group">
            <label for="FirstName" class="col-sm-2 control-label">First Name</label>
            <div class="col-sm-3">
                <input type="text" maxlength="50" class="form-control" id="FirstName" name="FirstName" placeholder="First Name" ng-model="UserModel.FirstName" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required/>
                <span  class="error-text-color" ng-show="(RegistrationForm.FirstName.$touched || RegistrationForm.$submitted) && RegistrationForm.FirstName.$invalid">{{ trans('messages.PropertyRequired',array('attribute'=>'First Name'))}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="LastName" class="col-sm-2 control-label">Last Name</label>
            <div class="col-sm-3">
                <input type="text" maxlength="50"  class="form-control" id="LastName" name="LastName" placeholder="Last Name" data-ng-model="UserModel.LastName"  ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required/>
                <span class="error-text-color" ng-show="(RegistrationForm.LastName.$touched || RegistrationForm.$submitted) && RegistrationForm.LastName.$invalid">{{ trans('messages.PropertyRequired',array('attribute'=>'Last Name'))}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="Email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-3">
                <input  id="Email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" type="email" ng-model="UserModel.Email" name="Email" placeholder="Enter Email" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required />
                <span class="error-text-color" ng-show="RegistrationForm.Email.$error.required &&  (RegistrationForm.Email.$touched || RegistrationForm.$submitted)">{{ trans('messages.PropertyRequired',array('attribute'=>'Email'))}}</span>
                <span class="error-text-color" ng-show="(!RegistrationForm.Email.$error.required) && (RegistrationForm.$dirty && RegistrationForm.Email.$invalid)">{{ trans('messages.InvalidEmail')}}</span>
            </div>
        </div>


        <div class="form-group">
            <label for="City" class="col-sm-2 control-label">City</label>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="City" name="City" placeholder="City" data-ng-model="UserModel.City" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required/>
                <span class="error-text-color" ng-show="(RegistrationForm.City.$touched || RegistrationForm.$submitted) && RegistrationForm.City.$invalid">{{ trans('messages.PropertyRequired',array('attribute'=>'City'))}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="City" class="col-sm-2 control-label">Select Gender</label>
            <div class="col-sm-3">
                <input type="radio" ng-model="UserModel.Gender" checked="checked" value="Male" />Male
                <input type="radio" ng-model="UserModel.Gender" value="Female" />Female<br />
            </div>
        </div>


        <div class="form-group">
            <label for="City" class="col-sm-2 control-label">Is Dummy User</label>
            <div class="col-sm-3">
                <input id="IsDummy" type="checkbox" ng-model="UserModel.IsDummy" ng-true-value="1" ng-false-value="0"/>
            </div>
        </div>

        <div class="form-group">
            <label for="City" class="col-sm-2 control-label">Select Role</label>
            <div class="col-sm-3">
                <select class="form-control" id="RoleID" name="RoleID" ng-model="UserModel.RoleID" ng-options="Role.RoleID as Role.RoleName for Role in RoleArray" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required><option value="">Please Select options</option></select>
                <span class="error-text-color" ng-show="(RegistrationForm.RoleID.$touched || RegistrationForm.$submitted) && RegistrationForm.RoleID.$invalid">{{ trans('messages.PropertyRequired',array('attribute'=>'Role'))}}</span>
            </div>
        </div>

        <div class="form-group">
            <label for="City" class="col-sm-2 control-label">Select DOB</label>
            <div class="col-sm-3">
                <div class="input-group date" id="datepicker" name="datepicker" datepicker  ng-dateval="UserModel.DOB" >
                <input type='text' class="form-control"/>
                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
             </div>
            </div>
        </div>


        <div class="form-group">
            <label for="City" class="col-sm-2 control-label">Select Active DateTime</label>
            <div class="col-sm-3">
                <div class="input-group date" id="DateTimePicker" datetimepicker  ng-dateval="UserModel.ActiveDateTime" data-ng-maxdate="MaxDOBDate">
                    <input type='text' class="form-control"/>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </div>


      <div class="form-group">
            <label for="City" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" ng-pattern=<?php echo \Infrastructure\Constants::$passwordRegex;?>  id="Password" name="Password" placeholder="Password" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" data-ng-model="UserModel.Password" required/>
                <span class="error-text-color" ng-show="RegistrationForm.Password.$error.required &&  (RegistrationForm.Password.$touched || RegistrationForm.$submitted)">{{ trans('messages.PropertyRequired',array('attribute'=>'Password'))}}</span>
                <span class="error-text-color" ng-show="(!RegistrationForm.Password.$error.required) && (RegistrationForm.$dirty && RegistrationForm.Password.$invalid)">{{ trans('messages.PasswordRegex')}}</span>
            </div>
        </div>
        <div class="form-group">
            <label for="City" class="col-sm-2 control-label">Confirm Password</label>
            <div class="col-sm-3">
                <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm Password" nx-equal-ex="UserModel.Password" data-ng-model="UserModel.ConfirmPassword" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required/>
                <span class="error-text-color" ng-show="RegistrationForm.ConfirmPassword.$error.required &&  (RegistrationForm.ConfirmPassword.$touched || RegistrationForm.$submitted)">{{ trans('messages.PropertyRequired',array('attribute'=>'Confirm Password'))}}</span>
                <span class="error-text-color" ng-show="RegistrationForm.ConfirmPassword.$error.nxEqualEx">Password & Confirm Password Must be equal!</span>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-10 col-sm-offset-2">
                <input id="submit" name="submit" type="submit" value="Save" class="btn btn-primary" data-ng-click="Save()">
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>


    </div>
</form>

</main>
@stop

@section('script')
    <script src="<?php echo asset('/assets/js/pagerjs/registration/registration.js');?>"></script>
@stop