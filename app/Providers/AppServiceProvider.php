<?php

namespace GistMed\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use GistMed\Channel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        //persists channels list on a ll pages.
        // \View::z('channels', \GistMed\Channel::all());
        \View::composer('*',function($view){
           $channels = \Cache::rememberForever('channels', function(){
               return Channel::all();
           });
            $view->with('channels',Channel::all());
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // if($this->app->isLocal()){
        //     $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        // }
    }
}
