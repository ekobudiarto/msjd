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
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');
Route::resource('public', 'HomeController@index');

//admin
	//dashboard
		Route::resource('admin/dashboard', 'Admin\dashboard\controller_admin_dashboard');
	//database
		//for search
		Route::get('admin/banned-report/search', 'Admin\database\controller_search@getSearchBannedReport');
		Route::get('admin/content/search', 'Admin\database\controller_search@getSearchContent');
		Route::get('admin/content-category/search', 'Admin\database\controller_search@getSearchContentCategory');
		Route::get('admin/hashtag/search', 'Admin\database\controller_search@getSearchHashtag');
		Route::get('admin/media-manager/search', 'Admin\database\controller_search@getSearchMediaManager');
		Route::get('admin/schedule/search', 'Admin\database\controller_search@getSearchSchedule');
		Route::get('admin/schedule-type/search', 'Admin\database\controller_search@getSearchScheduleType');
		Route::get('admin/users-group/search', 'Admin\database\controller_search@getSearchUsersGroup');
		Route::get('admin/users-status/search', 'Admin\database\controller_search@getSearchUsersStatus');
		Route::get('admin/users-detail/search', 'Admin\database\controller_search@getSearchUsersDetail');
		Route::get('admin/notification/search', 'Admin\database\controller_search@getSearchNotification');
		Route::get('admin/last-login/search', 'Admin\database\controller_search@getSearchLastLogin');
		
		// for CRUD
		Route::resource('admin/banned-report', 'Admin\database\controller_banned_report');
		Route::resource('admin/content', 'Admin\database\controller_content');
		Route::resource('admin/content-category', 'Admin\database\controller_content_category');
		Route::resource('admin/hashtag', 'Admin\database\controller_hashtag');
		Route::resource('admin/media-manager', 'Admin\database\controller_media_manager');
		Route::resource('admin/schedule', 'Admin\database\controller_schedule');
		Route::resource('admin/schedule-type', 'Admin\database\controller_schedule_type');
		Route::resource('admin/users-group', 'Admin\database\controller_users_group');
		Route::resource('admin/users-status', 'Admin\database\controller_users_status');
		Route::resource('admin/users-detail', 'Admin\database\controller_users_detail');
		Route::resource('admin/notification', 'Admin\database\controller_notification');
		Route::resource('admin/last-login', 'Admin\database\controller_last_login');

		//for publish
		Route::any('admin/ispublish', 'Admin\database\ispublish@index');



//login
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
//logout
Route::get('auth/logout', 'Auth\AuthController@getLogout');
//register
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
//reset Password
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
//test API register
Route::group(array('prefix'=>'api/v1'), function(){
  
  //Example API
  Route::get('get-profile', array('uses'=>'Api\get_profile@index'));
  Route::post('profile-upload', array('uses'=>'Api\get_profile@upload'));
  Route::post('profile-save', array('uses'=>'Api\get_profile@save_edit'));
  Route::post('signup', array('uses'=>'Api\controller_signup@index'));
  Route::post('login', array('uses'=>'Api\controller_login@index'));
  Route::get('get-roles', array('uses'=>'Api\roles@findAll'));
  Route::get('post-ban-report', array('uses'=>'Api\post_ban_report@index'));
  
  Route::get('set-schedule', array('uses'=>'Api\set_schedule@index'));
  Route::get('settings-profile', array('uses'=>'Api\settings_profile@index'));

  Route::get('schedule-user-get', array('uses'=>'Api\get_schedule_user@index'));
  Route::post('schedule-user-save', array('uses'=>'Api\get_schedule_user@input'));

  Route::get('content-user-get', array('uses'=>'Api\get_content@index'));
  Route::post('content-user-save', array('uses'=>'Api\get_content@input'));
  Route::post('content-user-detail', array('uses'=>'Api\get_content@detail'));
  Route::post('content-user-delete', array('uses'=>'Api\get_content@delete'));
  Route::post('content-user-media', array('uses'=>'Api\get_content@upload_media'));
  Route::get('content-user-search', array('uses'=>'Api\get_content@search_content'));
  Route::get('content-user-repost', array('uses'=>'Api\get_content@repost'));

  Route::post('post_hashtag', array('uses'=>'Api\post_hashtag@input'));

  Route::get('get_follower', array('uses'=>'Api\get_follower@index'));
  Route::get('get_request_follower', array('uses'=>'Api\get_follower@get_follower_request'));
  Route::post('post_request_follower', array('uses'=>'Api\get_follower@post_request_follower'));
  Route::post('accept_request_follower', array('uses'=>'Api\get_follower@accept_follower_request'));
  Route::post('reject_request_follower', array('uses'=>'Api\get_follower@reject_follower_request'));

});


//for auto complete 
Route::get('admin/autocomplete/getusername', 'Admin\database\autocomplete@getUsername');
Route::get('admin/autocomplete/getcontenttitle', 'Admin\database\autocomplete@getContentTitle');
Route::get('admin/autocomplete/getmediaid', 'Admin\database\autocomplete@getMediaId');
Route::get('admin/autocomplete/getcategoryid', 'Admin\database\autocomplete@getCategoryId');
Route::get('admin/autocomplete/getscheduletype', 'Admin\database\autocomplete@getScheduleType');
Route::get('admin/autocomplete/getstatusid', 'Admin\database\autocomplete@getStatusId');