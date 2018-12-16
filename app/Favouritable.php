<?php

namespace GistMed;

trait Favouritable{

    protected static function bootFavouritable()
    {
        static::deleting(function($model){
            $model->favourites->each->delete();
        });
    }

    //returns favourited reply???
    public function favourites()
    {
        return $this->morphMany(Favourite::class, 'favourited');
    }

    //Favourite a reply.
    public function favourite()
    {
        $attributes = ['expert_id' => auth('expert')->id()];

        if(!$this->favourites()->where($attributes)->exists()){
           return $this->favourites()->create($attributes);
        }
    }

    //Unfavourite a reply.
    public function unfavourite()
    {
        $attributes = ['expert_id' => auth('expert')->id()];

        $this->favourites()->where($attributes)->get()->each->delete();

    }
    
    public function isFavourited(){
        return !! $this->favourites->where('expert_id', auth('expert')->id())->count();
    }

    public function getIsFavouritedAttribute()
    {
        return $this->isFavourited();
    }

    public function getFavouritesCountAttribute(){
        return $this->favourites->count();
    }

}