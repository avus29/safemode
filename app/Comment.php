<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function blog(){
        return $this->belongsTo('GistMed\Blog');
    }

    public function user(){
        return $this->belongsTo('GistMed\User');
    }
}
