<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;
use GistMed\Thread;
use GistMed\Expert;

class Reply extends Model
{
    protected $guarded = [];

    //returns the thread which has this reply
    public function thread(){
      return  $this->belongsTo(Thread::class);
    }

    //returns the expert who is the author of a reply
    public function author(){
        return  $this->belongsTo(Expert::class,'expert_id');
    }

    //returns favourited reply???
    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favourited');
    }

    public function favourite()
    {
        $attributes = ['expert_id' => auth('expert')->id()];

        if(!$this->favourites()->where($attributes)->exists()){
           return $this->favourites()->create($attributes);
        }
    }
    
    public function isFavourited(){
        return $this->favourites()->where('expert_id' ,auth('expert')->id())->exists();
    }

}
