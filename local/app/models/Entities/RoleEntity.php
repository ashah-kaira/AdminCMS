<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class RoleEntity extends Eloquent{

	
	public $timestamps = false;
	public $table = 'lu_roles';
	public $primaryKey = 'RoleID';
	public $incrementing = 'RoleID';


    public $Model_Types = array(
        'RoleID'=>'int',
        'RoleName'=>'string',
    );

 
}
