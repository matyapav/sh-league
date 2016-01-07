<?php
/**
 * This file contains model for Invitation.
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Invitation was automatically generated with invitations migration. Not used in this project, but leaved here
 * for possible future needs.
 * @package App
 */
class Invitation extends Model {

    /**
     * Defines validation rules.
     * @var array Array of rules
     */
    public static $rules = [
        'user_id' => 'integer|required',
        'team_id' => 'integer|required',
    ];

    /**
     * The database table used by the model.
     *
     * @var string name of table
     */
    protected $table = 'invitations';

    /**
     * The attributes that are mass assignable
     * @var array Array of fillable values
     */
    protected $fillable = ['user_id', 'team_id'];

}
