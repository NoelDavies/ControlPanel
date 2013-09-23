<?php namespace Cysha\ControlPanel\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Lang;

use Cysha\ControlPanel\Controllers\Base\BaseController;

class LoginController extends BaseController {

	public function __construct(){
    	// Add csrf protection when posting forms
    	$this->beforeFilter('csrf', array('on' => 'post'));
    }

	public function getIndex() {
		$this->layout->content = View::make('controlpanel::login.form');
	}

	public function postIndex()	{
		$credentials = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
		);

		$remember = false;
		if( Input::has('remember-me') ){
			$remember = true;
		}

		if( !Auth::attempt($credentials, $remember) ){
			return Redirect::route('get admin/login')
				->with('reason', Lang::get('controlpanel::admin.messages.attempt-fail'))
				->with('error', 1);
		}else{
			return Redirect::to('admin');
		}
	}

	public function getLogout()	{
		Auth::logout();

		return Redirect::route('get admin/login')
			->with('success', Lang::get('controlpanel::admin.messages.logout-success'));
	}

	public function getForgotPassword() {
		$this->layout->content = View::make('controlpanel::login.forgot-password');
	}

	public function postForgotPassword() {
    	return Password::remind(array('email' => Input::get('email')));
	}

	public function getResetPassword($token) {
		$this->layout->content = View::make('controlpanel::login.password-reset')->with('token', $token);
	}

	public function postResetPassword($token) {
	    return Password::reset(array('email' => Input::get('email')), function($user, $password) {
	        $user->password = $password;
	        $user->forceSave();

	        return Redirect::route('get admin/login');
	    });
	}
}