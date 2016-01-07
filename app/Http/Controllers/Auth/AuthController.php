<?php
/**
 * This file contains registration and login controller
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * AuthController is Registration and Login controller, which handles the registration of new users,
 * as well as the authentication of existing users.
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller {


	use AuthenticatesAndRegistersUsers;

	/**
	 * AuthController constructor.
	 * @param Guard $auth
	 * @param Registrar $registrar
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

}
