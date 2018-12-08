<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;
use GistMed\Thread;

class Channel extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function threads(){
        return $this->hasMany(Thread::class);
    }
}
