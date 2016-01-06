<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model {

    // Add your validation rules here
    public static $rules = [
        'name' => 'required',
        'abbreviation' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['name', 'abbreviation', 'type', 'description'];

    /**
     * Get leagues associated with game
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leagues(){
        return $this->hasMany('App\League');
    }



}
