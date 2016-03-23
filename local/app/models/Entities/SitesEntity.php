<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class SitesEntity extends Eloquent implements UserInterface,   RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	public $timestamps = false;
	public $table = 'sites';
	public $primaryKey = 'SiteID';
	public $incrementing = 'SiteID';


    public $Model_Types = array(
        'SiteID'=>'int',
        'SiteName'=>'string'
    );



}
