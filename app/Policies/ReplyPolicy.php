<?php

namespace GistMed\Policies;

use GistMed\Expert;
use GistMed\Reply;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

     /**
     * Determine whether the user can update the reply.
     *
     * @param  \GistMed\Expert  $expert
     * @param  \GistMed\Thread  $thread
     * @return mixed
     */
    public function update(Expert $expert, Reply $reply)
    {
       return $reply->expert_id === $expert->id;
    }
}
