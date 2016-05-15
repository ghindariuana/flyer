<?php

namespace App;

use Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $table = 'flyers_photos';
    protected $fillable = ['path', 'name', 'thumbnail_path'];
    // refactored to method protected $baseDir = 'galery/photos';



    /** this is a boot method that will create trigger on events*/
    /* refactoredprotected static function boot()
    {
        static::creating(function($photo){
            // on creating will trigger this function
            return $photo->upload();
            // if return false then the process will abord so must return something
        });
    }*/

    /*protected static function boot()
    {
        static::creating(function($photo){
            $photo->setNameAttribute($photo->name);
            return True;
        });
    }


    /**
     * A photo belongs to a flyer
     * @return Illuminate\Database\Relations\BelongsTo
     * refactored
    public function flyer()
    {
        return $this->belongsTo('App\Flyer');
    }

    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;

        $photo->file = $file;

        /* refactoredreturn $photo->fill([
            'name'=> $photo->fileName(),
            'path'=> $photo->filePath(),
            'thumbnail_path'=> $photo->thumbnailPath(),
        ]);

    }*/


    /* refactor to App\AddPhotoToFlyer
    public function fileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->guessClientExtension();

        return "{$name}.{$extension}";
    }*/

    /** refactored in setnameattribute
    public function filePath()
    {
        return $this->baseDir() . '/' . $this->fileName();
    }

    public function thumbnailPath()
    {
        return $this->baseDir() . '/tn-' . $this->fileName();
    }*/

    public function baseDir()
    {
        return 'galery/photos';
    }


    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;

        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
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

    /* refactored protected function saveAs($name)
    {
        $this->name = sprintf('%s-%s', time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    } refactored*/

    /**
     * Move file to location
     *
    // Refactored public function move(UploadedFile $file)
    public function upload()
    {

        $this->file->move($this->baseDir(), $this->fileName());

        $this->makeThumbnail();

        return $this;
    } refactored to addphototoflyer/ refactored to addphototoflyer

    public function makethumbnail()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);

    }
    */
}
