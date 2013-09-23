<?php

/**
 * Add the login & logout routing, don\'t need to be logged in for this one to work
 *
 **/
Route::group(array ('prefix' => 'admin' ), function ()
{
	Route::controller('login', 'Cysha\ControlPanel\Controllers\LoginController');
	Route::get('logout', 'Cysha\ControlPanel\Controllers\LoginController@getLogout');
});



/**
 * Setup the rest of the routing, in this instance we want dashboard and some user stuff
 *
 **/
Route::group(array ('before' => 'auth', 'prefix' => 'admin' ), function ()
{
	Route::controller('dashboard', 'Cysha\ControlPanel\Controllers\DashboardController');

	Route::resource('user', 'Cysha\ControlPanel\Controllers\UserController');
	Route::put('user/{id}/change-password', 'Cysha\ControlPanel\Controllers\UserController@changePassword');
});
