<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function flyer()
    {
        return $this->hasMany(Flyer::class);
    }

    public function publish(Flyer $flyer)
    {
        $this->flyer()->save($flyer);
        return $flyer;
    }

    public function owns($relation)
    {

        return $relation->user_id == $this->id;
    }
}
