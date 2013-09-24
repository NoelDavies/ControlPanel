<?php

Route::filter('auth.admin', function(){
	if( Auth::guest() || !Auth::user()->is( Config::get('controlpanel::acp_groups') ) ){
		return Redirect::route('get admin/login')
			->with('error', Lang::get('controlpanel::admin.auth.permission-denied'));
	}
});
