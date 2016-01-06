<?php namespace App;
//todo comment file
use Illuminate\Database\Eloquent\Model;
//todo comment class PROBABLY NOT NEEDED MODEL
class TeamMember extends Model {

    // Add your validation rules here
    public static $rules = [
        'user_id' => 'integer|required',
        'team_id' => 'integer|required',
        'captain' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['user_id', 'team_id','captain'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tournament_teams';
}
