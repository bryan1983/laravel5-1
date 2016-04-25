<?php

namespace Curso\Repositories;


use Curso\Entities\User;

class VoteRepository
{
    public function vote(User $user, Ticket $ticket)
    {
        if(! $user->hasVoted($ticket)){
            $user->voted()->attach($ticket);
            return true;
        }else
            return false;
    }

    public function unvote(User $user, Ticket $ticket)
    {
        $user->voted()->detach($ticket);
    }

}