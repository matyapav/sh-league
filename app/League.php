<?php namespace App;
//todo comment file
use Illuminate\Database\Eloquent\Model;
//todo comment class
class League extends Model {


    /**
     * The database table used by the model.
     *
     * @var string name of table
     */
    protected $table = 'leagues';


    /**
     * Defines rules for validation
     *
     * @param $id pass this argument if you are updating record .. prevents error from unique fields validation
     * @return array Array of rules used by Validator
     */
    public static function rules($id){
        $rules =  [
            'game_id' => 'required',
            'name' => 'required|unique:leagues',
            'abbreviation' => 'required|unique:leagues'
        ];

        if(!empty($id)){
            $rules['name'] = 'required|unique:leagues,id,'.$id;
            $rules['abbreviation'] = 'required|unique:leagues,id,'.$id;
        }

        return $rules;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array array of fillable values
     */
    protected $fillable = ['name','abbreviation', 'description', 'game_id'];

    /**
     * Get tournaments in league (Relationship) - call get() on it to get collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany corresponding relationship
     */
    public function tournaments(){
        return $this->hasMany('App\Tournament', 'league_id', 'id');
    }

    /**
     * Get game which league belongs to (Relationship) - call without () to get game object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo corresponding relationship
     */
    public function game(){
        return $this->belongsTo('App\Game');
    }

    /**
     * Get creator of the league (Relationship) - call without () to get user object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo corresponding relationship
     */
    public function creator(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }


}
