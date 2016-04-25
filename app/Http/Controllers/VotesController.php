<?php

namespace Curso\Http\Controllers;

use Curso\Entities\Ticket;
use Curso\Repositories\TicketRepository;
use Curso\Repositories\VoteRepository;
use Illuminate\Http\Request;

use Curso\Http\Requests;
use Curso\Http\Controllers\Controller;

class VotesController extends Controller
{
    protected $ticketRepository;
    protected $voteRepository;

    public function __construct(TicketRepository $ticketRepository, VoteRepository $voteRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->voteRepository = $voteRepository;
    }

    public function submit($id)
    {
        // Comprobamos si el ticket existe o no
        $ticket = $this->ticketRepository->findOrFail($id);
        $this->voteRepository->vote( auth()->user(), $ticket);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $this->voteRepository->unvote(auth()->user(), $ticket);
        return redirect()->back();
    }
}
