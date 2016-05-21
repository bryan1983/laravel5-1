<?php

namespace Curso\Entities;


class TicketComment extends Entity
{

    protected $fillable = ['comment', 'link', 'selected'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::getClass());
    }

    public function user()
    {
        return $this->belongsTo(User::getClass());
    }
}
