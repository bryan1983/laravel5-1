<?php

namespace Curso\Http\Controllers;

use Curso\Entities\Ticket;
use Curso\Entities\TicketComment;
use Illuminate\Http\Request;

use Curso\Http\Requests;
use Curso\Http\Controllers\Controller;

class TicketsController extends Controller
{
    public function latest()
    {
        $tickets = Ticket::orderBy('created_at','DESC')->paginate(5);

        return view('tickets/list', compact('tickets'));
    }

    public function popular()
    {
        return view('tickets/list');
    }

    public function open()
    {
        $tickets = Ticket::where('status', 'open')->paginate(5);
        return view('tickets/list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = Ticket::where('status', 'closed')->paginate(5);
        return view('tickets/list', compact('tickets'));
    }

    public function details($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets/details', compact('ticket'));
    }
}
