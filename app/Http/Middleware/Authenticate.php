<?php
/**
 * This file contains middleware for authentication.
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

/**
 * Authenticate is laravel default middleware, which decides if user can access routes, which have auth middleware.
 * Laravel default.
 * @package App\Http\Middleware
 */
class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Authenticate constructor.
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
		if ($this->auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}

		return $next($request);

	}

}
