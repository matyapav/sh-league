<?php
/**
 * This file contains middleware for redirection after authentication
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;

/**
 * RedirectIfAuthenticated redirect user to main page if the user is already authenticated.
 * For example it is responsible for redirection after user registration. Laravel default.
 * @package App\Http\Middleware
 */
class RedirectIfAuthenticated {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * RedirectIfAuthenticated constructor.
	 * @param Guard $auth
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->check())
		{
			return new RedirectResponse(url('/'));
		}

		return $next($request);
	}

}
