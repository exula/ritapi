<?php

namespace Rit\Api;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider {

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
	public function boot()
	{
		//$this->package('rit/api');

        $this->publishes([
            __DIR__.'/config/config.php' => config_path('ritapi.php'),
        ]);

		$this->app->singleton(ApiConnection::class, function($app) {
		    return new ApiConnection();
        });
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
