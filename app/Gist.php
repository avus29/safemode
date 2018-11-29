<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;

class Gist extends Model
{

    public function answers(){
        return $this->hasMany('GistMed\Answer');
    }

    public function user(){
        return $this->belongsTo('GistMed\User','author_id');
    }
}
