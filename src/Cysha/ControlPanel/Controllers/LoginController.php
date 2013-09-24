<?php namespace Cysha\ControlPanel\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Lang;

use Teepluss\Theme\Facades\Theme;
use Cysha\ControlPanel\Controllers\Base\BaseController;

class LoginController extends BaseController {

	public function __construct(){
		// Add csrf protection when posting forms
		$this->beforeFilter('csrf', array('on' => 'post'));
		parent::__construct();
	}

	/**
	 * Get the login form, this will use the default theme
	 *
	 */
	public function getIndex() {
        $this->objTheme->layout('blank')->setLayout('blank');

		return $this->objTheme->of( 'controlpanel::login', $this->themeData )->render();
	}

	public function postIndex()	{
		$credentials = array(
			'identifier' 	=> Input::get('username'),
			'password' 		=> Input::get('password'),
		);

		$remember = false;
		if( Input::has('remember-me') ){
			$remember = true;
		}

		if( !Auth::attempt($credentials, $remember) ){
			return Redirect::route('get admin/login')
				->with('reason', Lang::get('controlpanel::admin.auth.attempt-fail'))
				->with('error', 1);
		}else{
			return Redirect::to('admin');
		}
	}

	public function getLogout()	{
		Auth::logout();

		return Redirect::route('get admin/login')
			->with('success', Lang::get('controlpanel::admin.auth.logout-success'));
	}

	public function getForgotPassword() {
		return $this->objTheme->of( 'controlpanel::forgotpassword', $this->themeData )->render();
	}

	public function postForgotPassword() {
		return Password::remind(array('email' => Input::get('email')));
	}

	public function getResetPassword($token) {
		return $this->objTheme->of( 'controlpanel::resetpassword', array_merge($this->themeData, array('token' => $token)) )->render();
	}

	public function postResetPassword($token) {
		return Password::reset(array('email' => Input::get('email')), function($user, $password) {
			$user->password = $password;
			$user->forceSave();

			return Redirect::route('get admin/login');
		});
	}
}