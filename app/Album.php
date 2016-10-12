<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public $timestamps = true;

    public $fillable = ['name'];

    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
