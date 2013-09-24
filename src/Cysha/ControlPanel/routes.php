<?php

/**
 * Add the login & logout routing, don\'t need to be logged in for this one to work
 *
 **/
Route::group(array ('prefix' => 'admin' ), function (){
	//Route::controller('login', 'Cysha\ControlPanel\Controllers\LoginController');

	// login & logout
	Route::get('login', 'Cysha\ControlPanel\Controllers\LoginController@getIndex');
	Route::post('login', 'Cysha\ControlPanel\Controllers\LoginController@postIndex');

	Route::get('logout', 'Cysha\ControlPanel\Controllers\LoginController@getLogout');

	// forgot password & reset password
	Route::get('forgot-password', 'Cysha\ControlPanel\Controllers\LoginController@getForgotPassword');
	Route::post('forgot-password', 'Cysha\ControlPanel\Controllers\LoginController@postForgotPassword');
	Route::get('reset-password', 'Cysha\ControlPanel\Controllers\LoginController@getResetPassword');
	Route::post('reset-password', 'Cysha\ControlPanel\Controllers\LoginController@postResetPassword');
});



/**
 * Setup the rest of the routing, in this instance we want dashboard and some user stuff
 *
 **/
Route::group(array ('before' => 'auth.admin', 'prefix' => 'admin' ), function (){
	Route::controller('dashboard', 'Cysha\ControlPanel\Controllers\DashboardController');

	Route::resource('user', 'Cysha\ControlPanel\Controllers\UserController');
	Route::put('user/{id}/change-password', 'Cysha\ControlPanel\Controllers\UserController@changePassword');
});
