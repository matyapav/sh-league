<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

    /**
     * Defines rules for validation
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

    // Don't forget to fill this array
    protected $fillable = ['name','avatar','abbreviation', 'description'];


    /**
     * Get users associated with the given team (team members)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function members(){
        return $this->belongsToMany('App\User', 'team_members');
    }

    /**
     * Get all sent invitations to users of given team
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sentInvitations(){
        return $this->belongsToMany('App\User', 'invitations');
    }

    /**
     * Get all tournaments where given team is signed in
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tournaments(){
        return $this->belongsToMany('App\Tournament','tournament_teams')->withTimestamps();
    }

    /**
     * Get the captain relationship between team and user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function captain(){
        return $this->belongsTo('App\User');
    }

   /* public static function get($id){
        return Team::find($id);
    }*/

}
