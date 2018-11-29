<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
   public function gist(){
    return $this->belongsTo('GistMed\Gist');
    }

    public function expert(){
        return $this->belongsTo('GistMed\Expert');
    }
}
