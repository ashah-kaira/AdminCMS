<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class StatusEntity extends Eloquent{

	
	public $timestamps = false;
	public $table = 'LU_UserStatuses';
	public $primaryKey = 'StatusID';
	public $incrementing = 'StatusID';


    public $Model_Types = array(
        'StatusID'=>'int',
        'Status'=>'string',
    );

 
}
