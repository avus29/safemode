<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;
use GistMed\Thread;
use GistMed\Expert;

class Reply extends Model
{

    use  Favouritable, RecordsActivity;

    protected $guarded = [];

    protected $appends = ['favouritesCount'];

    protected $with = ['author','favourites',];

    //returns the thread which has this reply
    public function thread(){
      return  $this->belongsTo(Thread::class);
    }

    //returns the expert who is the author of a reply
    public function author(){
        return  $this->belongsTo(Expert::class,'expert_id');
    }

}
