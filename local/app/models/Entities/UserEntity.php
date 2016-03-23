<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserEntity extends Eloquent implements UserInterface,   RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $timestamps = false;
	public $table = 'users';
	public $primaryKey = 'UserID';
	public $incrementing = 'UserID';


    public $Model_Types = array(
        'UserID'=>'int',
        'FirstName'=>'string',
        'LastName'=>'string',
        'City'=>'string',
        'Email'=>'string',
        'Gender'=>'string',
        'IsDummy'=>'int',
        'RoleID'=>'int',
        'DOB'=>'date',
        'ActiveDateTime'=>'datetime',
        'Password'=>'string'
    );

    public static $Add_rules = array(
        'FirstName'=>'required|max:50',
        'LastName'=>'required|max:50',
        'Email'=>'required|email|max:50',
        'City'=>'required',
        'Gender'=>'required',
        'RoleID'=>'required',
        //'Password'=> 'regex:/^(?=(.*\d){1})(?=.*[a-zA-Z])[0-9a-zA-Z\W]{8,15}$/',
        'Password'=> 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{12,}/',
        'ConfirmPassword' => 'same:Password'
    );

    public static $niceNameArray = array(
        'FirstName'=>'First Name',
        'LastName'=>'Last Name',
        'City'=>'City',
        'Email'=>'Email',
        'Gender'=>'Gender',
        'RoleID'=>'Role',
        'Password'=>'Password',
        'ConfirmPassword'=>'Confirm Password',
    );
   

}
