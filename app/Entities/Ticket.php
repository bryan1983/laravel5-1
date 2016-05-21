<?php

namespace Curso\Entities;


class Ticket extends Entity
{

    protected $fillable = ['title', 'link', 'status'];

    public function comments()
    {
        // For php <= 5.4
        //return $this->hasMany('Curso\Entities\TicketComment')

        // For php > 5.5
        //return $this->hasMany(TicketComment::class);

        // For all php
        return $this->hasMany(TicketComment::getClass());
    }

    public function voters()
    {
        return $this->belongsToMany(User::getClass(), 'ticket_votes')->withTimestamps();
    }

    public function author()
    {
        return $this->belongsTo(User::getClass(), 'user_id');
    }

    public function getOpenAttribute()
    {
        return $this->status == 'open';
    }
}
