<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model {

    // Add your validation rules here
    public static $rules = [
        'team1_id' => 'required',
        'team2_id' => 'required',
        'level' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['winner', 'level'];

    /**
     * Get first team which participates in given match
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function firstTeam(){
        return $this->belongsTo('App\Team', 'team1_id', 'id');
    }

    /**
     * Get second team which participates in given match
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function secondTeam(){
        return $this->belongsTo('App\Team', 'team2_id', 'id');
    }

    /**
     * Get first previous match from which is given match derived from
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function firstPreviousMatch(){
        return $this->belongsTo('App\Match', 'prev_match1_id', 'id');
    }

    /**
     * Get second previous match from which is given match derived from
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secondPreviousMatch(){
        return $this->belongsTo('App\Match', 'prev_match2_id', 'id');
    }

    /**
     * Get tournament which given match belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tournament(){
        return $this->belongsTo('App\Tournament');
    }

}
