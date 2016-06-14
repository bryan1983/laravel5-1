<?php

namespace Curso\Policies;


use Curso\Entities\Ticket;
use Curso\Entities\User;

class TicketPolicy
{
    public function selectResource(User $user, Ticket $ticket)
    {
        return $user->id == $ticket->user_id;
    }
}
