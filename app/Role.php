<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    public static $rules = [
        'name' => 'required|unique:roles',
    ];

    // Don't forget to fill this array
    protected $fillable = ['name', 'description'];

    /**
     * Get users with given role
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany('App\User', 'user_roles')->withTimestamps();
    }
}
