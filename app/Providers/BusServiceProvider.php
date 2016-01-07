<?php
/**
 * This file contains bus service provider
 */
namespace App\Providers;

use Illuminate\Bus\Dispatcher;
use Illuminate\Support\ServiceProvider;

/**
 * Laravel default BusServiceProvider. Not used in this project, but leaved for future needs, such as registering Commands
 * @package App\Providers
 */
class BusServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @param  \Illuminate\Bus\Dispatcher  $dispatcher
	 * @return void
	 */
	public function boot(Dispatcher $dispatcher)
	{
		$dispatcher->mapUsing(function($command)
		{
			return Dispatcher::simpleMapping(
				$command, 'App\Commands', 'App\Handlers\Commands'
			);
		});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
