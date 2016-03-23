<?php
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class EmailEntity extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $timestamps = false;
	public $table = 'emails';
	public $primaryKey = 'EmailID';
	public $incrementing = 'EmailID';

	 public $Model_Types = array(
		'EmailID'=>'int',
	    'ToEmail'=>'string',
	 	'Subject'=>'string',
	 	'Body'=>'longtext',
	 	'CreatedDate'=>'datetime',
	 	'CreatedBy'=>'int',
	 	'IsSent'=>'int',
	 	'MailAttempt'=>'int',
        'token'=>'string'
	);
}

