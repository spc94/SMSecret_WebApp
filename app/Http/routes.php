<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('QRHome', "QRCodeHome@displayQR");

//Route::match(['get','post'],'JSONGetter',"JSONGetter@receiver");
Route::post ('JSONGetter',"JSONGetter@receiver");
Route::post ('JSONInbox',"JSONInbox@receiver");

Route::get ('SessionController/getTime', "SessionController@getTime");
Route::get ('SessionController/setTime', "SessionController@setTime");

//Route for Deleting SMS
Route::get('Instructions/deleteSmsUnenc',"InstructionsController@deleteSmsUnenc");
Route::get('Instructions/deleteSmsEnc',"InstructionsController@deleteSmsEnc");

//Route for Sending SMS
Route::get('Instructions/sendSms',"InstructionsController@sendSms");
/*Route::get('QRHome', function()
{
    return View::make('QRHomeView');
});*/

Route::get('GetString', "GetStringController@main");

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
