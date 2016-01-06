<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
