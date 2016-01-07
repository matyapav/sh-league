<?php
/**
 * This file contains Registrar service.
 */
namespace App\Services;
use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

/**
 * Class Registrar validates and registers new User of application.
 * @package App\Services
 */
class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'nickname' => 'required|max:255|unique:users',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'nickname' => htmlspecialchars($data['nickname']),
			'avatar' => $data['avatar'],
			'email' => htmlspecialchars($data['email']),
			'city' => htmlspecialchars($data['city']),
			'state'=> htmlspecialchars($data['state']),
			'birthdate'=>$data['birthdate'],
			'name'=> htmlspecialchars($data['name']),
			'info'=> htmlspecialchars($data['info']),
			'password' => bcrypt($data['password']),
		]);
	}

}
