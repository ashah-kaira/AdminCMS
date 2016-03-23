<?php
use \Infrastructure\Constants;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Login Controller Routes

/* RB Region Start */
Route::get('/',array('uses' => 'SecurityController@getLogin'));
Route::get('unauthorize', array('uses' => 'SecurityController@getunauthorized'));
Route::get('login',array('uses' => 'SecurityController@getLogin'));
Route::post('authenticate', array('uses' => 'SecurityController@postAuthenticate'));
Route::get('sendforgotpassword', array('uses' => 'SecurityController@getsendforgotpassword'));
Route::get('choosesite',array('uses' => 'SecurityController@getChooseSite'));
Route::get('logout', array('uses' => 'SecurityController@getLogout'));

Route::post('verification', array('uses' => 'SecurityController@postSendVerificationEmail'));
/* RB Region End */


/* Ayushi Region Start */
Route::get('add/{userid?}', array('uses' => 'UserController@getAddUser'));
Route::post('saveuser', array('uses' => 'UserController@postSaveUser'));
/* Ayushi Region End */


/*Start Region Dev_Vishal*/

Route::get('userlist',array('uses' => 'UserController@getUserList'));
Route::post('getuserlist',array(    'uses' => 'UserController@postUserList'));

Route::get('dirPagination',array('uses' => 'UserController@getPagination'));

/*Stop Region Dev_Vishal*/

?>