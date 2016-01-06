<?php namespace App;
//todo comment file
use Illuminate\Database\Eloquent\Model;
//todo comment class
class Match extends Model {

    /**
     * The database table used by the model.
     *
     * @var string name of table
     */
    protected $table = 'matches';

    /**
     * Validation rules for match
     *
     * @var array array of rules
     */
    public static $rules = [
        'team1_id' => 'required',
        'team2_id' => 'required',
        'level' => 'required'
    ];

    /**
     * The attributes that are mass assignable
     *
     * @var array array of fillable values
     */
    protected $fillable = ['winner', 'level'];

    /**
     * Get first team which participates in given match (Relationship) - call without () to get team object
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne corresponding relationship
     */
    public function firstTeam(){
        return $this->belongsTo('App\Team', 'team1_id', 'id');
    }

    /**
     * Get second team which participates in given match (Relationship) - call without () to get team object
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne corresponding relationship
     */
    public function secondTeam(){
        return $this->belongsTo('App\Team', 'team2_id', 'id');
    }

    /**
     * Get first previous match from which is given match derived from (Relationship) - call without () to get match object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo corresponding relationship
     */
    public function firstPreviousMatch(){
        return $this->belongsTo('App\Match', 'prev_match1_id', 'id');
    }

    /**
     * Get second previous match from which is given match derived from (Relationship) - call without () to get match object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo corresponding relationship
     */
    public function secondPreviousMatch(){
        return $this->belongsTo('App\Match', 'prev_match2_id', 'id');
    }

    /**
     * Get tournament which given match belongs to (Relationship) - call without () to get tournament object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo corresponding relationship
     */
    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }

}
