<?php

namespace App;

use function foo\func;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    // Records the activity to be posted on the users profile
    use RecordsActivity;

    protected $guarded = [];

    // Fetches creator for every query made to Thread
    protected $with = ['creator', 'channel'];

    protected static function boot() {
        parent::boot();

        // Global queryset replies_count to get number of replies of each thread
        // static::addGlobalScope('replyCount', function ($builder){
        //     $builder->withCount('replies');
        // });

        // When deleting a thread; delete all replies associated with it
        static::deleting(function ($thread){
            $thread->replies->each->delete();
        });

    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function addReply($reply)
    {
        return $this->replies()->create($reply);
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

    public function subscribe()
    {

    }

    public function subscription()
    {
        return $this->hasMany(ThreadSubscription::class);
    }
}
