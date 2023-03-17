<?php
use Illuminate\Support\Facades\Input;

Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm'); 

Auth::routes();

Route::group(array('prefix' => LaravelLocalization::setLocale() . '/admin', 'namespace' => 'Admin'), function () {

	Route::get('/dashboard', 'HomeController@index')->name('home');


	/*
	 |--------------------------------------------------------------------------
	 | MODUL MULTIMEDIA
	 |--------------------------------------------------------------------------
	*/
	Route::get('multimedia',
	[
		'as'=>'multimedia.index',
		'uses'=>'MultimediaController@index',
	]);
	Route::get('/get_multimedia_data','MultimediaController@get_group_user_data');
	Route::get('/get_multimedia_data_byid','MultimediaController@get_group_user_data_byid');
	Route::post('/multimedia/save','MultimediaController@save');
	Route::post('/multimedia/update','MultimediaController@update');
	Route::post('/multimedia/change_status_active/{id}','MultimediaController@change_status_active');
	Route::post('/multimedia/change_status_inactive/{id}','MultimediaController@change_status_inactive');
	Route::post('/multimedia/deleted_all/{id}','MultimediaController@delete_all');
	Route::post('/multimedia/deleted','MultimediaController@delete');


	/*
	 |--------------------------------------------------------------------------
	 | MODUL SETTING
	 |--------------------------------------------------------------------------
	*/
	// Profile & Setting
	Route::get('/my_profile','SettingController@my_profile');
	Route::post('/check_username','SettingController@check_username');
	Route::post('/update_profile','SettingController@update_profile');
	Route::post('/UpdateInlineName',  'SettingController@UpdateInlineName');
	Route::post('/UpdateInlineEmail',  'SettingController@UpdateInlineEmail');
	Route::post('/UpdateInlineTelephone',  'SettingController@UpdateInlineTelephone');
	Route::post('/UpdateInlineAddress',  'SettingController@UpdateInlineAddress');

	// Users
	Route::get('users',
	[
		'as'=>'users.index',
		'uses'=>'UsersController@index',
	]);
	Route::get('/get_users_data','UsersController@get_users_data');
	Route::get('/get_users_data_byid','UsersController@get_users_data_byid');
	Route::post('save_users','UsersController@save_users');
	Route::post('update_users','UsersController@update_users');
	Route::post('deleted_users','UsersController@deleted_users');


	// Group User
	Route::get('group_user',
	[
		'as'=>'group_user.index',
		'uses'=>'GroupUserController@index',
	]);
	Route::get('/get_group_user_data','GroupUserController@get_group_user_data');
	Route::get('/get_group_user_data_byid','GroupUserController@get_group_user_data_byid');
	Route::post('/group_user/save','GroupUserController@save');
	Route::post('/group_user/update','GroupUserController@update');
	Route::post('/group_user/change_status_active/{id}','GroupUserController@change_status_active');
	Route::post('/group_user/change_status_inactive/{id}','GroupUserController@change_status_inactive');
	Route::post('/group_user/deleted_all/{id}','GroupUserController@delete_all');
	Route::post('/group_user/deleted','GroupUserController@delete');


	// Users Role
	Route::get('roles',
	[
		'as'=>'roles.index',
		'uses'=>'RoleController@index',
	]);
	Route::get('roles/create',[
		'as'=>'roles.create',
		'uses'=>'RoleController@create',
	]);
	Route::get('roles/get_roles_byid','RoleController@get_roles_byid');
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store']);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit']);
	Route::post('/roles/change_status_active/{id}','RoleController@change_status_active');
	Route::post('/roles/change_status_inactive/{id}','RoleController@change_status_inactive');
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update']);
	Route::post('/roles/deleted_all/{id}','RoleController@delete_all');
	Route::post('roles/delete','RoleController@delete');
});