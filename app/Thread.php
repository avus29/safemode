<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;
use GistMed\Reply;
use GistMed\ThreadFilters;

class Thread extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builer){
            $builer->withCount('replies');
        });
    }

    //return the replies to this thread.
    public function replies(){
       return $this->hasMany(Reply::class);
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
