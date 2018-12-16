<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;
use GistMed\Reply;
use GistMed\ThreadFilters;

class Thread extends Model
{
    use RecordsActivity;

    protected $guarded = [];
    protected $with = ['creator','channel'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builer){
            $builer->withCount('replies');
        });

        static::deleting(function ($thread){
            $thread->replies->each->delete();
            // $thread->replies->each(function ($reply){
            //     $reply ->delete();
            // });
        });

    }

    //return the replies to this thread.
    public function replies(){
       return $this->hasMany(Reply::class)->withCount('favourites')->with('author');
    }

    //return the expert who is the creator of this thread.
    public function creator(){
        return  $this->belongsTo(Expert::class,'expert_id');
    }

    //add a reply to a thread
    public function addReply($reply){
        $this->replies()->create($reply);
    }

     //return the channel this thread belongs to.
     public function channel(){
        return  $this->belongsTo(Channel::class);
    }

    public function scopeFilter($query, $filters){
        return $filters->apply($query);
    }
}
