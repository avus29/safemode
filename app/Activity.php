<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
   protected $guarded = [];

   public function subject()
   {
       return $this->morphTo();
   }

   public static function feed(Expert $expert, $take=50)
   {
    return static::where('expert_id', $expert->id)
    ->latest()
    ->with('subject')
    ->take($take)
    ->get()
    ->groupBy(function ($activity){
        return $activity->created_at->format('Y-m-d');
    });
   }
}
