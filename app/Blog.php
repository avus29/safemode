<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
   public function comments(){
       return $this->hasMany('GistMed\Comment');
   }

   public function expert(){
    return $this->belongsTo('GistMed\Expert','author_id');
}
}
