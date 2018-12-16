<?php

namespace GistMed;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        if (auth('expert')->guest()) return;//May have to delete this later if it breaks other thins

        foreach (static::getActivitiesToRecord() as $event){
            static::$event(function($model)use ($event){
                $model->recordActivity($event);
         });
        }

        static::deleting(function ($model){
            $model->activity()->delete();
        });
        
    }

    protected static function getActivitiesToRecord()
    {
       return ['created'];
    }

    protected function recordActivity($event)
    {
      $this->activity()->create([
            'expert_id' => auth('expert')->id(),
            'type' => Self::getActivityType($event),
        ]);
    }

    public function activity()
    {
        return $this->morphMany('GistMed\Activity', 'subject');
    }

    protected function getActivityType($event)
    {
       $type = strtolower((new \ReflectionClass($this))->getShortName());

        return "{$event}_{$type}";
    }

}