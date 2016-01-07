<?php
/**
 * This file contains configuration service provider.
 */
namespace App\Providers;


use Illuminate\Support\ServiceProvider;

/**
 * Laravel default ConfigServiceProvider. Not used in this project, but leaved here for possible future needs.
 * @package App\Providers
 */
class ConfigServiceProvider extends ServiceProvider {

	/**
	 * Overwrite any vendor / package configuration.
	 *
	 * This service provider is intended to provide a convenient location for you
	 * to overwrite any "vendor" or package configuration that you may want to
	 * modify before the application handles the incoming request / command.
	 *
	 * @return void
	 */
	public function register()
	{
		config([
			//
		]);
	}

}
