<?php namespace Cysha\ControlPanel\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

use Cysha\ControlPanel\Controllers\Base\BaseController;

class DashboardController extends BaseController {

	public function getIndex() {
		$this->setupLayout();

		$data = $this->themeData;
		return $this->objTheme->of( 'controlpanel::dashboard.index', $data)->render();
	}
}