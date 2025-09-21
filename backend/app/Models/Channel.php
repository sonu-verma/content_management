<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Channel extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\ChannelFactory> */
    use HasFactory;

    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function image(){

        if($this->media->first()){
            return $this->media->first()->getFullUrl('thumb');;
        }

        return null;
        
    }

    /**
     * Optionally define media conversions (resize, thumbnails etc.)
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width( 100)
              ->height(100)
              ->sharpen(20)
             ->nonQueued();  
    }

}
