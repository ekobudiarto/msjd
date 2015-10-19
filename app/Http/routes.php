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
Route::resource('admin/banned-report', 'Admin\controller_banned_report');
Route::resource('admin/content', 'controller_content');
Route::resource('admin/content-category', 'controller_content_category');
Route::resource('admin/media-manager', 'controller_media_manager');
Route::resource('admin/schedule', 'controller_schedule');
Route::resource('admin/schedule-type', 'controller_schedule_type');
Route::resource('admin/users', 'controller_users');
Route::resource('admin/users-group', 'controller_users_group');


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


