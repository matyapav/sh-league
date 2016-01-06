<?php namespace App\Providers;
//todo comment file
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DateTime;
//todo comment class
class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		Validator::extend('greater_than_field', function($attribute, $value, $parameters, $validator) {
			$other = Input::get($parameters[0]);
			return isset($other) and intval($value) >= intval($other);
		});

		Validator::replacer('greater_than_field', function($message, $attribute, $rule, $parameters) {
			return str_replace(':field', $parameters[0], $message);
		});

		Validator::extend('is_after_date', function($attribute, $value, $parameters, $validator) {
			$other = Input::get($parameters[0]);
			return isset($other) and (new DateTime($value)) >= (new DateTime($other));
		});

		Validator::replacer('is_after_date', function($message, $attribute, $rule, $parameters) {
			return str_replace(':field', $parameters[0], $message);
		});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
