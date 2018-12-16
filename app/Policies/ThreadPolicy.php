<?php

namespace GistMed\Policies;


use GistMed\Thread;
use Illuminate\Auth\Access\HandlesAuthorization;
use GistMed\Expert;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function before(Expert $expert){
        //Allows admin to get authorisation.
        if($expert->id == 3){
            return true;
        }
    }

    /**
     * Determine whether the user can view the thread.
     *
     * @param  \GistMed\User  $user
     * @param  \GistMed\Thread  $thread
     * @return mixed
     */
    public function view(User $user, Thread $thread)
    {
        //
    }

    /**
     * Determine whether the user can create threads.
     *
     * @param  \GistMed\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the thread.
     *
     * @param  \GistMed\Expert  $expert
     * @param  \GistMed\Thread  $thread
     * @return mixed
     */
    public function update(Expert $expert, Thread $thread)
    {
       return $thread->expert_id == $expert->id;
    }

    /**
     * Determine whether the user can delete the thread.
     *
     * @param  \GistMed\User  $user
     * @param  \GistMed\Thread  $thread
     * @return mixed
     */
    public function delete(User $user, Thread $thread)
    {
        //
    }

    /**
     * Determine whether the user can restore the thread.
     *
     * @param  \GistMed\User  $user
     * @param  \GistMed\Thread  $thread
     * @return mixed
     */
    public function restore(User $user, Thread $thread)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the thread.
     *
     * @param  \GistMed\User  $user
     * @param  \GistMed\Thread  $thread
     * @return mixed
     */
    public function forceDelete(User $user, Thread $thread)
    {
        //
    }
}
