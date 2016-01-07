<?php
/**
 * This file contains model for User Role Relationship.
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRole was automatically generated with user_role migration. Not used in this project, but leaved here
 * for possible future needs.
 * @package App
 */
class UserRole extends Model {

    /**
     * The table associated with the model.
     *
     * @var string Name of table used by this model
     */
    protected $table = 'user_roles';

    /**
     * Defines validation rules.
     * @var array Array of rules
     */
    public static $rules = [
        'user_id' => 'integer|required',
        'role_id' => 'integer|required',
    ];

    /**
     * The attributes that are mass assignable
     * @var array Array of fillable values
     */
    protected $fillable = ['user_id', 'role_id'];

}
