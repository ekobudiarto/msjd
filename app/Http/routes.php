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

Route::resource('banned-report', 'controller_banned_report');
Route::resource('content', 'controller_content');
Route::resource('ontent-category', 'controller_content_category');
Route::resource('media-manager', 'controller_media_manager');
Route::resource('schedule', 'controller_schedule');
Route::resource('schedule-type', 'controller_schedule_type');
Route::resource('users', 'controller_users');
Route::resource('users-group', 'controller_users_group');
