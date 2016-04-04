<?php

namespace Curso\Http\Controllers;

use Curso\Entities\Ticket;
use Illuminate\Http\Request;

use Curso\Http\Requests;
use Curso\Http\Controllers\Controller;

class VotesController extends Controller
{
    public function submit($id)
    {
        // Comprobamos si el ticket existe o no
        $ticket = Ticket::findOrFail($id);
        auth()->user()->vote($ticket);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        auth()->user()->unvote($ticket);
        return redirect()->back();
    }
}
