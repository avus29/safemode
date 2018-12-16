<?php

namespace GistMed;

use Illuminate\Database\Eloquent\Model;
use GistMed\Expert;

class Favourite extends Model
{
    use RecordsActivity;
  
    protected $guarded = [];

    public function favourited()
    {
        return $this->morphTo();
    }
}
