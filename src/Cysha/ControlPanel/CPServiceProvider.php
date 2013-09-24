<?php namespace Cysha\ControlPanel;

use Illuminate\Support\ServiceProvider;

class CPServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot() {
		$this->package('cysha/controlpanel');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register() {
		// include the config directory
		$this->app['config']->package('cysha/controlpanel', __DIR__.'/../../config');


		// we have a few default routes in the admin panel, do we want to use them?
		if( $this->app['config']->get('controlpanel::default_routing') === true ){
			include __DIR__.'/routes.php';
		}

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides() {
		return array('controlpanel');
	}

}