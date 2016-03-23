@extends('layouts.sitemaster')
@section('Title','User List')
@stop
@section('css')
    <link href="<?php echo asset('/assets/css/datetimepicker/bootstrap-datetimepicker.min.css');?>" rel="stylesheet" type='text/css'>
    <link href="<?php echo asset('/assets/css/datetimepicker/bootstrap-datetimepicker-standalone.css');?>" rel="stylesheet" type='text/css'>
@stop
@section('content')
<?php
    echo Form::hidden('ListModel', json_encode($ListModel), $attributes = array('id' => 'ListModel'));
?>
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" data-ng-controller = "UserListController">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="#">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Manage User</span>
                </li>
            </ul>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <a href="<?php echo URL::to('/add'); ?>" class="btn btn-primary btn-sm btn-outline"> Add User </a>
                </div>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Manage User
            <!--<small>dashboard & statistics</small>-->
        </h3>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <!-- BEGIN Form Design-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <form>
                    <div class="form-body">
                            <div class="form-group col-md-2">
                                <input type="text" class="form-control" data-ng-model="ListModel.frontSearchModel.LastName" id="LastName" name="LastName" placeholder="LastName">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" class="form-control" data-ng-model="ListModel.frontSearchModel.Email" id="Email" name="Email" placeholder="Email">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" id="Status" name="Status" data-ng-model="ListModel.frontSearchModel.StatusID">
                                    <option ng-repeat="data in ListModel.StatusLookup" value="@{{data.StatusID}}">@{{data.Status}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control" id="Role" name="Role" data-ng-model="ListModel.frontSearchModel.RoleID">
                                    <option ng-repeat="data in ListModel.rolesLookup" value="@{{data.RoleID}}">@{{data.Role}}</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <button data-ng-click="SearchUserRecords()" class="btn btn-info btn-search">Search</button>
                            </div>
                    </div>
                </form>
                <div data-ng-if="UserList.length > 0" class="table-responsive col-md-12">
                    <table class="table table-striped table-bordered table-hover">
                        <thead class="site-footer">
                        <tr>
                            <th>
                                <span class="anchor_color" href="javascript:;" data-ng-click="ListPager.sortColumn('FirstName')">FirstName</span>
                                <span class="sortorder" data-ng-show="ListPager.sortIndex === 'FirstName'" data-ng-class="{reverse:ListPager.reverse}"></span>
                            </th>
                            <th>
                                <span class="anchor_color" href="javascript:;" data-ng-click="ListPager.sortColumn('LastName')">LastName</span>
                                <span class="sortorder" data-ng-show="ListPager.sortIndex === 'LastName'" data-ng-class="{reverse:ListPager.reverse}"></span>
                            </th>
                            <th>
                                <span class="anchor_color" href="javascript:;" data-ng-click="ListPager.sortColumn('Email')">Email</span>
                                <span class="sortorder" data-ng-show="ListPager.sortIndex === 'Email'" data-ng-class="{reverse:ListPager.reverse}"></span>
                            </th>
                            <th>
                                <span class="anchor_color" href="javascript:;" data-ng-click="ListPager.sortColumn('Role')">Role</span>
                                <span class="sortorder" data-ng-show="ListPager.sortIndex === 'Role'" data-ng-class="{reverse:ListPager.reverse}"></span>
                            </th>
                            <th>
                                <span class="anchor_color" href="javascript:;" data-ng-click="ListPager.sortColumn('Status')">Status</span>
                                <span class="sortorder" data-ng-show="ListPager.sortIndex === 'Status'" data-ng-class="{reverse:ListPager.reverse}"></span>
                            </th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody dir-paginate="data in UserList | itemsPerPage:ListPager.pageSize" total-items="ListPager.totalRecords" current-page="ListPager.currentPage" pagination-id="UserID">
                        <tr>
                            <td>@{{data.FirstName}}</td>
                            <td>@{{data.LastName}}</td>
                            <td>@{{data.Email}}</td>
                            <td>@{{data.Role}}</td>
                            <td>@{{data.Status}}</td>
                            <td>
                                <div>
                                    <a ng-click="EditUser(data)" title="Edit User Detail" ><i class="fa fa-pencil fa-edit-color" ></i></a>
                                    &nbsp;
                                    <a><i class="fa fa-times fa-delete-color"></i></a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                    <div class="col-md-12" data-ng-if="UserList.length > 0">
                        <dir-pagination-controls boundary-links="true"  on-page-change="ListPager.pageChanged(newPageNumber)" pagination-id="UserID">
                        </dir-pagination-controls>
                    </div>
                    <div class="form-group col-md-12" align="center"data-ng-if="UserList.length == 0">
                        <b>Sorry, no users found.</b>
                    </div>
            </div>
        </div>
        <!-- END DASHBOARD STATS 1-->
    </div>
    <!-- END CONTENT BODY -->
@stop

@section('script')
       <script src="<?php echo asset('/assets/js/pagerjs/userlist/userlist.js') ?>"></script>
@stop