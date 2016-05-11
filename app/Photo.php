<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Image;

class Photo extends Model
{

    protected $table = 'flyers_photos';
    protected $fillable = ['path', 'name', 'thumbnail_path'];
    protected $baseDir = 'galery/photos';
    /**
     * A photo belongs to a flyer
     * @return Illuminate\Database\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    /**
     * Create and save photo from form
     */
    /*Refactor public static function fromForm(UploadedFile $file)
    {
        #$photo = new static;
        #$name = time(). $file->getClientOriginalName();

        #$photo->path = $photo->baseDir . '/' . $name;  // use photo instance not self or this
        return (new static)->saveAs($file->getClientOriginalName());

        #return $photo;

    } Refactor*/

    /**
     * The name of the file
     */
    public function named($name)
    {
        return (new static)->saveAs($name);

    }

    protected function saveAs($name)
    {
        $this->name = sprintf('%s-%s', time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    }

    /**
     * Move file to location
     */
    public function move(UploadedFile $file)
    {

        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;
    }

    public function makethumbnail()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);

    }
}
