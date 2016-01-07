<?php
/**
 * This file contains model for Team.
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Team model
 * @package App
 */
class Team extends Model {

    /**
     * The database table used by the model.
     * @var string Name of table
     */
    protected $table = 'teams';

    /**
     * Defines rules for validation of team
     *
     * @param $id pass this argument if you are updating record .. prevents error from unique fields validation
     * @return array Array of rules used by Validator
     */
    public static function rules($id){
        $rules =  [
            'name' => 'required|unique:teams',
            'avatar' => '',
            'abbreviation' => 'required|unique:leagues',
            'description' => 'required'
        ];

        if(!empty($id)){
            $rules['name'] = 'required|unique:teams,id,'.$id;
            $rules['abbreviation'] = 'required|unique:teams,id,'.$id;
        }

        return $rules;
    }

    /**
     * The attributes that are mass assignable
     *
     * @var array array of fillable values
     */
    protected $fillable = ['name','avatar','abbreviation', 'description'];


    /**
     * Get users associated with the given team (team members) (Relationship) - call get() on it to get collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany corresponding relationship
     */
    public function members(){
        return $this->belongsToMany('App\User', 'team_members');
    }

    /**
     * Get all sent invitations to users of given team (Relationship) - call get() on it to get teams
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany corresponding relationship
     */
    public function sentInvitations(){
        return $this->belongsToMany('App\User', 'invitations');
    }

    /**
     * Get all tournaments where given team is signed in (Relationship) - call get() on it to get collection
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany corresponding relationship
     */
    public function tournaments(){
        return $this->belongsToMany('App\Tournament','tournament_teams')->withTimestamps();
    }

    /**
     * Get the captain relationship between team and user (Relationship) - call without () to get the user object
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo corresponding relationship
     */
    public function captain(){
        return $this->belongsTo('App\User');
    }

}
