<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model {


    protected $table = 'leagues';


    /**
     * Defines rules for validation
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

    // Don't forget to fill this array
    protected $fillable = ['name','abbreviation', 'description', 'game_id'];

    /**
     * Get tournaments in league
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tournaments(){
        return $this->hasMany('App\Tournament', 'league_id', 'id');
    }

    /**
     * Get game which league belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game(){
        return $this->belongsTo('App\Game');
    }

    /**
     * Get creator of the league
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }


}
