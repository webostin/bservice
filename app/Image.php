<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;

class Image extends Model
{
    use CounterCache;

    public $counterCacheOptions = [
        'album' => ['field' => 'images_count', 'foreignKey' => 'album_id']
    ];

    public $timestamps = true;

    public $fillable = [
        'album_id',
        'image_url',
        'alt',
    ];

    public function album()
    {
        return $this->belongsTo('App\Album', 'album_id');
    }
}
