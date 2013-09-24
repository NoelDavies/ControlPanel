<?php

Route::filter('auth.admin', function(){
	return Auth::user()->is( Config::get('controlpanel::acp_groups') );
});
