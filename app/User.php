<?php namespace App;
//todo comment file
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
//todo comment class
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['nickname', 'avatar', 'email', 'city', 'state', 'birthdate', 'name', 'info', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Returns invitations from teams of given user (Relationship) - call get() on it to get collection
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany correcponding relationship
	 */
	public function invitations(){
		return $this->belongsToMany('App\Team', 'invitations')->withTimestamps();
	}

	/**
	 * Get all teams associated with given user (Relationship) - call get() on it to get collection
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany corresponding relationship
	 */
	public function teams(){
		return $this->belongsToMany('App\Team', 'team_members')->withTimestamps();
	}

	/**
	 * Get all teams where user is captain (Relationship) - call get() on it to get collection
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany corresponding relationship
	 */
	public function teamsWhereUserIsCaptain(){
		return $this->hasMany('App\Team', 'captain_id', 'id');
	}

	/**
	 * Get leagues which user created (Relationship) - call get() on it to get collection
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany corresponding relationship
	 */
	public function createdLeagues(){
		return $this->hasMany('App\League', 'created_by', 'id');
	}

	/**
	 * Get roles associated with given user (Relationship) - call get() on it to get collection
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany corresponding relationship
	 */
	public function roles(){
		return $this->belongsToMany('App\Role', 'user_roles');
	}

	/**
	 * Rules for validating authentication
	 *
	 * @var array
	 */
	public static $auth_rules = [
			'nickname' => 'required',
			'password' => 'required'
	];

	/**
	 * Rules for validating forms for creating and updating Users
	 *
	 * @var array
	 */
	public static $register_rules = [
			'nickname' => 'required|unique:users',
			'password' => 'required',
			'mail' => 'email|required|unique:users',
			'city' => 'required',
			'state' => 'required'
	];

	/**
	 * Checks if user has specific role .. note  that normal user has no role (so his role is null)
	 *
	 * @param null $rolename Name of the role which can be null. If null no role is given.
	 * @return bool true if user has this role, false if not
	 */
	public function hasRole($rolename = null){
		foreach($this->roles()->get() as $role){
			if($role->name == $rolename){
				return true;
			}
		}
		return false;
	}

	/**
	 * Checks if authenticated user is captain of given team
	 *
	 * @param $team specific team
	 * @return bool true if user is captain of team, false otherwise
	 */
	public function isCaptain($team){
		if(is_null($team->captain)){
			return false;
		}
		return $this->id == $team->captain->id;
	}

}
