<?php

namespace GistMed;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GistMed\Notifications\ExpertResetPasswordNotification;

class Expert extends Authenticatable
{
    use Notifiable;

    //Explicit guard to use
    protected $guard = 'experts';
    //Explicit table name
    protected $table = 'experts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone','gender','birthday','profession','employer','designation','avatar', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

      /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ExpertResetPasswordNotification($token));
    }

    //Return the blogs associated with an expert
    public function blogs(){
        return $this->hasMany('GistMed\Blog','author_id','id');
    }

    //Return the answers associated with an expert
    public function answers(){
        return $this->hasMany('GistMed\Answer','expert_id','id');
    }

     //Return the replies associated with an expert
     public function replies(){
        return $this->hasMany('GistMed\Reply','expert_id','id');
    }

    //Return the threads created by an expert
    public function threads(){
        return $this->hasMany('GistMed\Thread','expert_id','id')->latest();
    }

    //Return the experts activity log
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }

}
