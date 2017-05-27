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

/*Route::get('QRHome', function()
{
    return View::make('QRHomeView');
});*/

Route::get('GetString', "GetStringController@main");

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
