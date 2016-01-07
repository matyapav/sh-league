<?php
/**
 * This file contains eloquent model for Game.
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Game model
 * @package App
 */
class Game extends Model {

    /**
     * The database table used by the model.
     *
     * @var string name of table
     */
    protected $table = 'games';

    /**
     * Validation rules for game
     *
     * @var array array of rules
     */
    public static $rules = [
        'name' => 'required',
        'abbreviation' => 'required'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array array of fillable values
     */
    protected $fillable = ['name', 'abbreviation', 'type', 'description'];

    /**
     * Get leagues associated with game (Relationship) - call get() on it to get collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany corresponding relationship
     */
    public function leagues(){
        return $this->hasMany('App\League');
    }



}
