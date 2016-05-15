<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{

    /**
     * Filable forms for a flyer
     */
    protected $fillable = [
        'street', 'city', 'country', 'zip', 'price', 'description', 'user_id'
    ];


    /*refactor  in  User model since user have multiple flyers
    protected static function boot()
    {
        static::creating(function($flyer){
            $flyer->setUserIdAttribute();
            return True;
        });
    } refactor*/

    /**
     * A flyer is composed of many photos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }


    public function addPhoto(Photo $photo)
    {
        #dd([$photo, $photo->baseDir ]);
        return $this->photos()->save($photo);
    }




    /**
     * accessor to get info
     * @param string $zip postal code
     *
     */
    /*public function scopeLocatedAt($query, $zip, $street)
    {
        $street = str_replace('-', ' ', $street);
        return $query->where(compact('zip', 'street'));
    }
    REFACTORED TO
    */

    /**
     ** accessor to get info
     * @param string $zip postal code
     *
     */
    static function locatedAt($zip, $street) //$query required for scope
    {
        $street = str_replace('-', ' ', $street);
        return static::where(compact('zip', 'street'))->firstOrFail();
    }

    /**
     * Modifier for price
     */
    public function getPriceAttribute($price)
    {
        return '$ ' . number_format($price);
    }

    /** refactor, taken care by User publish
     * setter for user_id
     *
    public function setUserIdAttribute()
    {
        #die(isset($value) ? "user_id have this value = $value" : " no value for user_id");
        $this->attributes['user_id'] = Auth::user()->id;
    }refactor*/

    /**
     * setter for street
     *
    public function setStreetAttribute($value)
    {
        die($value);
    }*/

    /** setter for created _at
    *
    public function setCreatedAtAttribute($value)
    {
        die(isset($value) ? "created_at have this value = $value" : " no value for user_id");

    }*/


    /**
     * use to check ownership
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     *  Return the id of the owner
     *  @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ownedBy(User $user)
    {
        #print_r([$this->user_id, $user->id, $this->user_id == $user->id]);
        return $this->user_id == $user->id;
    }

    public function move($photo)
    {
        #$photo
        #die(print_r([$photo]));

    }
}
