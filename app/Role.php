<?php
/**
 * This file contains model for Role
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Role model
 * @package App
 */
class Role extends Model {

    /**
     * The database table used by the model.
     *
     * @var string name of table
     */
    protected $table = 'roles';

    /**
     * Validation rules for role
     *
     * @var array array of rules
     */
    public static $rules = [
        'name' => 'required|unique:roles',
    ];

    /**
     * The attributes that are mass assignable
     *
     * @var array array of fillable values
     */
    protected $fillable = ['name', 'description'];

    /**
     * Get users with given role (Relationship) - call get() on it to get collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany corresponding relationship
     */
    public function users(){
        return $this->belongsToMany('App\User', 'user_roles')->withTimestamps();
    }
}
