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

    protected $with = ['user'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function totalSubscriptions(){
        return $this->subscriptions()->count();
    }
    
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

    public function editable(){
        if(! auth()->check()) return false;
        return auth()->check() && auth()->user()->id === $this->user_id;
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function isSubscribed(){
        return $this->hasOne(Subscription::class)->where("user_id", auth()->user()?->id);
    }
}
