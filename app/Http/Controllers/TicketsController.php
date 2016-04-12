<?php

namespace Curso\Http\Controllers;

use Curso\Entities\Ticket;
use Curso\Entities\TicketComment;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use Curso\Http\Requests;
use Curso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class TicketsController extends Controller
{

    public function latest()
    {
        $tickets = Ticket::orderBy('created_at','DESC')->with('author')->paginate(5);

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

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request, Guard $auth)
    {
        $this->validate($request, [
            'title' => 'required|max:120'
        ]);

        $ticket = $auth->user()->tickets()->create([
            'title'     =>  $request->get('title'),
            'status'    => 'open'
        ]);

        /*$ticket = new Ticket();
        $ticket->title = $request->get('title');
        $ticket->status = 'open';
        $ticket->user_id = $auth->user()->id;
        $ticket->save();*/

        return Redirect::route('tickets.details', $ticket->id);
    }
}
