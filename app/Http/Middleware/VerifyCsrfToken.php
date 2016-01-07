<?php
/**
 * This file contains middleware for verifying CSRF token.
 */
namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

/**
 * VerifyCsrfToken verifies csrf token, which is needed for example while using POST requests. Laravel default.
 * @package App\Http\Middleware
 */
class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		return parent::handle($request, $next);
	}

}
