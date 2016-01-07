<?php
/**
 * This file contains model for Team Member relationship
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamMember was automatically generated with team_members migration. Not used in this project, but leaved here
 * for possible future needs.
 * @package App
 */
class TeamMember extends Model {

    /**
     * Defines validation rules.
     * @var array Array of rules
     */
    public static $rules = [
        'user_id' => 'integer|required',
        'team_id' => 'integer|required',
    ];

    /**
     * The attributes that are mass assignable
     * @var array Array of fillable values
     */
    protected $fillable = ['user_id', 'team_id'];

    /**
     * The table associated with the model.
     *
     * @var string Name of table used by this model
     */
    protected $table = 'tournament_teams';
}
