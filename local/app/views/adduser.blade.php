@extends('layouts.sitemaster')
@section('Title')
    <?php isset($UserModel->UserDetail->UserID) ? print 'Edit User' : print 'Add User';?>
@stop
@section('css')
    <link href="<?php echo asset('/assets/css/datetimepicker/bootstrap-datetimepicker.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/datetimepicker/bootstrap-datetimepicker-standalone.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css');?>" rel="stylesheet" type='text/css'>
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
                    <span><?php isset($UserModel->UserDetail->UserID) ? print 'Edit User' : print 'Add User';?></span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> <?php isset($UserModel->UserDetail->UserID) ? print 'Edit User' : print 'Add User';?>
            <!--<small>dashboard & statistics</small>-->
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN Form Design-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE FORM PORTLET-->
               <form name="RegistrationForm" id="RegistrationForm" role="form" novalidate>
                    <div class="form-body" ng-controller = "UserController"  ng-cloak>
                        <div class="col-md-3">
                            <div data-provides="fileinput" class="fileinput fileinput-new">
                                <div style="width: 200px; height: 200px;" class="fileinput-new thumbnail">
                                    <img alt="" src="http://www.placehold.it/200x200/EFEFEF/AAAAAA&amp;text=no+image"> </div>
                                <div style="max-width: 200px; max-height: 200px; line-height: 10px;" class="fileinput-preview fileinput-exists thumbnail"> </div>
                                <div>
                                    <span class="btn default btn-file">
                                    <span class="fileinput-new"> Select image </span>
                                    <span class="fileinput-exists"> Change </span>
                                    <input type="hidden"><input type="file" name="..."> </span>
                                    <a data-dismiss="fileinput" class="btn red fileinput-exists" href="javascript:;"> Remove </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9  no-padding">
                            <div class="col-md-12  no-padding">
                                <div class="form-group col-md-6" ng-class="{ 'has-error' : (RegistrationForm.FirstName.$touched || RegistrationForm.$submitted) && RegistrationForm.FirstName.$invalid}">
                                    <label for="FirstName" class="control-label">First Name</label>
                                    <input class="form-control"  type="text" name="FirstName" ng-model="UserModel.FirstName" 	ng-class="{ 'has-submitted' : RegistrationForm.$submitted || RegistrationForm.FirstName.$touched }" required />
                                    <div  class="help-block" ng-messages="RegistrationForm.FirstName.$error" ng-if="RegistrationForm.FirstName.$touched || RegistrationForm.$submitted">
                                        <div  ng-message="required">{{ trans('messages.PropertyRequired',array('attribute'=>'First Name'))}}</div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6" ng-class="{ 'has-error' : (RegistrationForm.LastName.$touched || RegistrationForm.$submitted) && RegistrationForm.LastName.$invalid}">
                                    <label for="LastName" class="control-label">Last Name</label>
                                    <input class="form-control"  type="text" name="LastName" ng-model="UserModel.LastName" 	ng-class="{ 'has-submitted' : RegistrationForm.$submitted || RegistrationForm.LastName.$touched }" required />
                                    <div class="help-block"  ng-messages="RegistrationForm.LastName   .$error" ng-if="RegistrationForm.LastName.$touched || RegistrationForm.$submitted">
                                        <div ng-message="required">{{ trans('messages.PropertyRequired',array('attribute'=>'Last Name'))}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  no-padding">
                                <div class="form-group  col-md-6" ng-class="{ 'has-error' : (RegistrationForm.Email.$touched || RegistrationForm.$submitted) && RegistrationForm.Email.$invalid}">
                                    <label for="Email" class="control-label">Email</label>
                                    <input class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" type="email" name="Email" ng-model="UserModel.Email" ng-class="{ 'has-submitted' : RegistrationForm.$submitted || RegistrationForm.Email.$touched }"	required />
                                    <div class="help-block" ng-messages="RegistrationForm.Email.$error" ng-if="RegistrationForm.Email.$touched || RegistrationForm.$submitted">
                                        <div ng-message="required">{{ trans('messages.PropertyRequired',array('attribute'=>'Email'))}}</div>
                                        <div ng-message="pattern">{{ trans('messages.InvalidEmail')}}</div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6" ng-class="{ 'has-error' : (RegistrationForm.RoleID.$touched || RegistrationForm.$submitted) && RegistrationForm.RoleID.$invalid}">
                                    <label for="RoleID" class="control-label">Select Role</label>
                                    <select class="form-control" id="RoleID" name="RoleID" ng-model="UserModel.StatusID" ng-options="St.StatusID as St.Status for St in StatusArray" ng-init="UserModel.StatusID=StatusArray[0].StatusID"  ng-class="{ 'has-submitted' : RegistrationForm.$submitted || RegistrationForm.RoleID.$touched}" ng-disabled="disabled" required><option value="">Please Select options</option></select>
                                    <div class="help-block"  ng-messages="RegistrationForm.RoleID.$error" ng-if="RegistrationForm.RoleID.$touched || RegistrationForm.$submitted">
                                        <div ng-message="required">{{ trans('messages.PropertyRequired',array('attribute'=>'Role'))}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12  no-padding">
                                <div class="col-md-12"><label for="RoleID" class="control-label">Permissions</label></div>
                                <div class="col-md-3 ">
                                    <h4>Mercer Vine</h4>
                                    <label class="radio">
                                        <input type="radio" name="gender" ng-model="UserModel.Gender" checked="checked" value="Male" />
                                        Blogger / Designer
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender" ng-model="UserModel.Gender" value="Female" />
                                        Marketing Director
                                    </label>
                                </div>
                                <div class="col-md-3  no-padding">
                                    <h4>Colorado</h4>
                                    <label class="radio">
                                        <input type="radio" name="gender1" ng-model="UserModel.Gender" checked="checked" value="Male" />
                                        Blogger / Designer
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender1" ng-model="UserModel.Gender" value="Female" />
                                        Marketing Director
                                    </label>
                                </div>
                                <div class="col-md-3  no-padding">
                                    <h4>Woodbridge Wealth</h4>
                                    <label class="radio">
                                        <input type="radio" name="gender2" ng-model="UserModel.Gender" checked="checked" value="Male" />
                                        Blogger / Designer
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender2" ng-model="UserModel.Gender" value="Female" />
                                        Marketing Director
                                    </label>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <h4>Riverdale Funding</h4>
                                    <label class="radio">
                                        <input type="radio" name="gender3" ng-model="UserModel.Gender" checked="checked" value="Male" />
                                        Blogger / Designer
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="gender3" ng-model="UserModel.Gender" value="Female" />
                                        Marketing Director
                                    </label>
                                </div>
                            </div>
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
    <script src="<?php echo asset('/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js');?>"></script>
    <script src="<?php echo asset('/assets/js/pagerjs/registration/registration.js');?>"></script>
@stop