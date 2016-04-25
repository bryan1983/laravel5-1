<?php

namespace Curso\Http\Controllers;

use Curso\Entities\Ticket;
use Curso\Entities\TicketComment;
use Curso\Repositories\TicketRepository;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;

use Curso\Http\Requests;
use Curso\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class TicketsController extends Controller
{
    /**
     * @var TicketRepository
     */
    private $TicketRepository;

    public function __construct(TicketRepository $TicketRepository)
    {
        $this->TicketRepository = $TicketRepository;
    }

    public function latest()
    {
        //$tickets = Ticket::orderBy('created_at','DESC')->with('author')->paginate(5);
        $tickets = $this->TicketRepository->paginateLatest();
        return view('tickets/list', compact('tickets'));
    }

    public function popular()
    {
        return view('tickets/list');
    }

    public function open()
    {
        $tickets = $this->TicketRepository->paginateOpen();
        return view('tickets/list', compact('tickets'));
    }

    public function closed()
    {
        $tickets = $this->TicketRepository->paginateClosed();
        return view('tickets/list', compact('tickets'));
    }

    public function details($id)
    {
        $ticket = $this->TicketRepository->findOrFail($id);
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

        $ticket = $this->TicketRepository->openNew($auth->user(), $request->get('title'));
        return Redirect::route('tickets.details', $ticket->id);
    }
}
