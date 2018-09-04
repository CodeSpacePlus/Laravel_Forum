<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;

    protected $guarded = [];

    protected $appends = ['favoritesCount', 'isFavorited'];

    // Fetches owner and favorites with every Reply query
    protected $with = ['owner', 'favorites'];
    
    protected static function boot()
    {
        parent::boot();

        // Everytime a new reply is created increase the 'replies_count' of that thread
        static::created(function($reply) {
            $reply->thread->increment('replies_count');
        });

        // Everytime a reply is deleted decrease the 'replies_count' of that thread
        static::deleted(function($reply) {
            $reply->thread->decrement('replies_count');
        });


    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }
}
