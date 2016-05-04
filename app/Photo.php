<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $table = 'flyers_photos';
    protected $fillable = ['photo'];
    /**
     * A photo belongs to a flyer
     * @return Illuminate\Database\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }
}
