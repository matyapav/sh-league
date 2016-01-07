<?php
/**
 * This file contains middleware for admin role.
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

/**
 * AdminMiddleware handles routes by which is admin middleware specified. Decides if user is admin or not - so has right
 * to access route and redirects user to corresponding page.
 * @package App\Http\Middleware
 */
class AdminMiddleware {


	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if (Auth::check()) {
			if (Auth::user()->hasRole('admin')) {
				return $next($request);
			}
			return Redirect::back()->withErrors(trans('messages.admin'));
		}
		return Redirect::to('/auth/login')->withErrors(trans('messages.logged-in'));
	}

}
