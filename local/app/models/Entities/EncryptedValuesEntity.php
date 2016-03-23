<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class EncryptedValueEntity extends Eloquent implements  RemindableInterface {

	use UserTrait, RemindableTrait;
	public $timestamps = false;
	protected $table = 'encryptedvalues';
	protected $primaryKey = 'ID';
	public $incrementing = 'ID';
}
