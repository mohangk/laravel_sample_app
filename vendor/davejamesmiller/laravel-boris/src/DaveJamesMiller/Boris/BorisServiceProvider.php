<?php namespace DaveJamesMiller\Boris;

use Illuminate\Support\ServiceProvider;

class BorisServiceProvider extends ServiceProvider {

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('command.boris');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['command.boris'] = $this->app->share(function($app)
		{
			return new BorisCommand;
		});

		$this->commands('command.boris');
	}

}
