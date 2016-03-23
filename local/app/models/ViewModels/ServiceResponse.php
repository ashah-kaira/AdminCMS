<?php
namespace ViewModels;

class ServiceResponse {
	public $IsSuccess;
	public $Data;
	public $Message;
	public $ErrorCode;
	//public $ErrorMessages;
	
	public function __construct($IsSuccess = false){
		$this->IsSuccess = $IsSuccess;
		$this->ErrorCode = 0;
	}
}
