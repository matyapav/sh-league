<?php
/**
 * This file contains model for Tournament Team relationship.
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TournamentTeam was automatically generated with tournament_team migration. Not used in this project, but leaved here
 * for possible future needs.
 * @package App
 */
class TournamentTeam extends Model {

    /**
     * The table associated with the model.
     *
     * @var string Name of table used by this model
     */
    protected $table = 'tournament_teams';

    /**
     * Defines validation rules.
     * @var array Array of rules
     */
    public static $rules = [
        'team_id' => 'integer|required',
        'tournament_id' => 'integer|required',
    ];

    /**
     * The attributes that are mass assignable
     * @var array Array of fillable values
     */
    protected $fillable = ['team_id', 'tournament_id'];


}
