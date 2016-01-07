<?php
/**
 * This file contains controller for password resets.
 */
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Auth\ResetsPasswords;

/**
 * Laravel default PasswordController is responsible for handling password reset requests. NOT USED IN THIS PROJECT,
 * but it is leaved here to future needs
 * @package App\Http\Controllers\Auth
 */
class PasswordController extends Controller {

	use ResetsPasswords;

	/**
	 * PasswordController constructor.
	 * @param Guard $auth
	 * @param PasswordBroker $passwords
	 */
	public function __construct(Guard $auth, PasswordBroker $passwords)
	{
		$this->auth = $auth;
		$this->passwords = $passwords;
		$this->middleware('guest');
	}

}
