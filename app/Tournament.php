<?php namespace App;
//todo comment file
use Illuminate\Database\Eloquent\Model;
//todo comment class
class Tournament extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tournaments';

    /**
     * Defines rules for validation of tournament
     *
     * @param $id pass this argument if you are updating record .. prevents error from unique fields validation
     * @return array Array of rules used by Validator
     */
    public static function rules($id){
        $rules =  [
            'league_id' => 'integer|required',
            'min_number_of_teams' => 'integer|required|min:0',
            'max_number_of_teams' => 'integer|required|min:0|greater_than_field:min_number_of_teams',
            'start_date' => 'required',
            'end_date' => 'required|is_after_date:start_date',
            'name' => 'string|required|unique:tournaments',
        ];

        if(!empty($id)){
            $rules['name'] = 'required|unique:tournaments,id,'.$id;

        }

        return $rules;
    }

    /**
     * The attributes that are mass assignable
     *
     * @var array array of fillable values
     */
    protected $fillable = ['league_id', 'min_number_of_teams', 'max_number_of_teams', 'start_date', 'end_date', 'name', 'description'];

    /**
     * Get all teams which are signed in given tournament (Relationship) - call get() on it to get collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany corresponding relationship
     */
    public function signedTeams(){
        return $this->belongsToMany('App\Team', 'tournament_teams');
    }

    /**
     * Get league which tournament belongs to. (Relationship) - call without () to get league object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo corresponding relationship
    */
    public function league(){
        return $this->belongsTo('App\League');
    }

    /**
     * Get matches in given tournament (Relationship) - call get() on it to get collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany corresponding relationship
     */
    public function matches(){
        return $this->hasMany('App\Match', 'tournament_id', 'id');
    }
}
