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

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', 'HomeController@index');

//admin
	//dashboard
		Route::resource('admin/dashboard', 'Admin\dashboard\controller_admin_dashboard');
	//database
		Route::resource('admin/banned-report', 'Admin\database\controller_banned_report');
		Route::resource('admin/content', 'Admin\database\controller_content');
		Route::resource('admin/content-category', 'Admin\database\controller_content_category');
		Route::resource('admin/media-manager', 'Admin\database\controller_media_manager');
		Route::resource('admin/schedule', 'Admin\database\controller_schedule');
		Route::resource('admin/schedule-type', 'Admin\database\controller_schedule_type');
		Route::resource('admin/users', 'Admin\database\controller_users');
		Route::resource('admin/users-group', 'Admin\database\controller_users_group');
		Route::resource('admin/users-status', 'Admin\database\controller_users_status');



//login
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
//register
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
//logout
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

//test API register
Route::group(array('prefix'=>'api/v1'), function(){
  
  //Example API
  Route::get('signup', array('as'=>'signup','uses'=>'Api\controller_signup@index'));
  Route::get('login', array('as'=>'login','uses'=>'Api\controller_login@index'));
  Route::get('get_roles', array('uses'=>'Api\roles@findAll'));
});