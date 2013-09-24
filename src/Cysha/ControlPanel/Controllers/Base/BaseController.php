<?php namespace Cysha\ControlPanel\Controllers\Base;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Teepluss\Theme\Facades\Theme;

class BaseController extends Controller {

	public $objTheme;
	public $themeData = array();

	protected function __construct(){
        $this->objTheme = Theme::uses( Config::get('controlpanel::acp_layout') )
        					 ->layout( Config::get('controlpanel::acp_columns') )
                             ->setLayout( Config::get('controlpanel::acp_columns') );

    	$this->themeData = array(
    		'_siteName' => Config::get('app.site-name'),
    	);

    	return $this;
	}

}