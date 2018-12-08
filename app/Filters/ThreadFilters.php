<?php

    namespace GistMed;


    class ThreadFilters extends Filters
    {
        protected $filters = ['whose','popular'];
        
        //Filter the query by a given expertID
        protected function whose($expert_id){
            
            $expert = Expert::where('id',$expert_id)->firstOrFail();
            
            return $this->builder->where('expert_id', $expert->id);
        }

        //Filter the query by popularity
        protected function popular()
        {
            $this->builder->getQuery()->orders = [];
            return $this->builder->orderBy('replies_count','desc');
        }




    }