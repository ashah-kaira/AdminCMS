@extends('layouts.sitemaster')
@section('Title')
    <?php isset($UserModel->UserDetail->UserID) ? print 'Edit User' : print 'Add User';?>
@stop
@section('css')
    <link href="<?php echo asset('/assets/css/datetimepicker/bootstrap-datetimepicker.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/datetimepicker/bootstrap-datetimepicker-standalone.css');?>" rel="stylesheet" type='text/css'>
@stop
@section('content')
<main id="main" role="main">
<?php echo Form::hidden('UserModel', json_encode($UserModel),$attributes = array('id'=>'UserModel')); ?>
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="#">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Add/Edit User</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Add User
            <!--<small>dashboard & statistics</small>-->
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN Form Design-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE FORM PORTLET-->
               <form name="RegistrationForm" id="RegistrationForm" role="form" novalidate>
                    <div class="form-body" ng-controller = "UserController">
                        <div class="col-md-12  no-padding">
                            <div class="form-group col-md-6" ng-class="{ 'has-error' : (RegistrationForm.FirstName.$touched || RegistrationForm.$submitted) && RegistrationForm.FirstName.$invalid}">
                                <label for="FirstName" class="control-label">First Name</label>
                                <input type="text" maxlength="50" class="form-control" id="FirstName" name="FirstName" placeholder="First Name" ng-model="UserModel.FirstName" required/>
                                <span class="help-block" ng-show="(RegistrationForm.FirstName.$touched || RegistrationForm.$submitted) && RegistrationForm.FirstName.$invalid">{{ trans('messages.PropertyRequired',array('attribute'=>'First Name'))}}</span>
                            </div>

                            <div class="form-group col-md-6" ng-class="{ 'has-error' : (RegistrationForm.LastName.$touched || RegistrationForm.$submitted) && RegistrationForm.LastName.$invalid}">
                                <label for="LastName" class="control-label">Last Name</label>
                                <input type="text" maxlength="50"  class="form-control" id="LastName" name="LastName" placeholder="Last Name" data-ng-model="UserModel.LastName" required/>
                                <span class="help-block" ng-show="(RegistrationForm.LastName.$touched || RegistrationForm.$submitted) && RegistrationForm.LastName.$invalid">{{ trans('messages.PropertyRequired',array('attribute'=>'Last Name'))}}</span>
                            </div>
                        </div>
                        <div class="col-md-12  no-padding">
                            <div class="form-group  col-md-6">
                                <label for="Email">Email</label>
                                <input  id="Email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" class="form-control" type="email" ng-model="UserModel.Email" name="Email" placeholder="Enter Email" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required />
                                <span class="error-text-color" ng-show="RegistrationForm.Email.$error.required &&  (RegistrationForm.Email.$touched || RegistrationForm.$submitted)">{{ trans('messages.PropertyRequired',array('attribute'=>'Email'))}}</span>
                                <span class="error-text-color" ng-show="(!RegistrationForm.Email.$error.required) && (RegistrationForm.$dirty && RegistrationForm.Email.$invalid)">{{ trans('messages.InvalidEmail')}}</span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="City" >City</label>
                                <input type="text" class="form-control" id="City" name="City" placeholder="City" data-ng-model="UserModel.City" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required/>
                                <span class="error-text-color" ng-show="(RegistrationForm.City.$touched || RegistrationForm.$submitted) && RegistrationForm.City.$invalid">{{ trans('messages.PropertyRequired',array('attribute'=>'City'))}}</span>
                            </div>
                        </div>
                        <div class="col-md-12  no-padding">
                            <div class="form-group  col-md-6">
                                <label for="City">Select Gender</label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" ng-model="UserModel.Gender" checked="checked" value="Male" />
                                        Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" ng-model="UserModel.Gender" value="Female" />
                                        Female
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Dummy User</label>
                                <div class="checkbox-list">
                                    <label class="checkbox-inline">
                                        <input id="IsDummy" type="checkbox" ng-model="UserModel.IsDummy" ng-true-value="1" ng-false-value="0"/>
                                        Is Dummy User
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="City" >Select Role</label>
                            <select class="form-control" id="RoleID" name="RoleID" ng-model="UserModel.RoleID" ng-options="Role.RoleID as Role.RoleName for Role in RoleArray" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required><option value="">Please Select options</option></select>
                            <span class="error-text-color" ng-show="(RegistrationForm.RoleID.$touched || RegistrationForm.$submitted) && RegistrationForm.RoleID.$invalid">{{ trans('messages.PropertyRequired',array('attribute'=>'Role'))}}</span>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="City">Select DOB</label>
                            <div class="input-group date  date-picker" id="datepicker" name="datepicker" datepicker  ng-dateval="UserModel.DOB" data-ng-maxdate="MaxDOBDate">
                                <input type='text' class="form-control"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="City">Select Active DateTime</label>
                            <div class="input-group date" id="DateTimePicker" datetimepicker  ng-dateval="UserModel.ActiveDateTime" data-ng-maxdate="MaxDOBDate">
                                <input type='text' class="form-control"/>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>

                       <div class="form-group col-md-6">
                            <label for="City">Password</label>
                            <input type="password" class="form-control" ng-pattern=<?php echo \Infrastructure\Constants::$passwordRegex;?>  id="Password" name="Password" placeholder="Password" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" data-ng-model="UserModel.Password" required/>
                            <span class="error-text-color" ng-show="RegistrationForm.Password.$error.required &&  (RegistrationForm.Password.$touched || RegistrationForm.$submitted)">{{ trans('messages.PropertyRequired',array('attribute'=>'Password'))}}</span>
                            <span class="error-text-color" ng-show="(!RegistrationForm.Password.$error.required) && (RegistrationForm.$dirty && RegistrationForm.Password.$invalid)">{{ trans('messages.PasswordRegex')}}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="City">Confirm Password</label>
                            <input type="password" class="form-control" id="ConfirmPassword" name="ConfirmPassword" placeholder="Confirm Password" nx-equal-ex="UserModel.Password" data-ng-model="UserModel.ConfirmPassword" ng-class="{ 'has-submitted' : RegistrationForm.$submitted}" required/>
                            <span class="error-text-color" ng-show="RegistrationForm.ConfirmPassword.$error.required &&  (RegistrationForm.ConfirmPassword.$touched || RegistrationForm.$submitted)">{{ trans('messages.PropertyRequired',array('attribute'=>'Confirm Password'))}}</span>
                            <span class="error-text-color" ng-show="RegistrationForm.ConfirmPassword.$error.nxEqualEx">Password & Confirm Password Must be equal!</span>
                        </div>

                        <div class="form-actions  col-md-12">
                            <input id="submit" name="submit" type="submit" value="Save" class="btn blue" data-ng-click="Save()">
                            <button type="button" class="btn default">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END DASHBOARD STATS 1-->
    </div>
    <!-- END CONTENT BODY -->
</main>
@stop

@section('script')
    <script src="<?php echo asset('/assets/js/datetimepicker/bootstrap-datetimepicker.js');?>"></script>
    <script src="<?php echo asset('/assets/js/pagerjs/registration/registration.js');?>"></script>
@stop