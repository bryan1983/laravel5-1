<?php

namespace Curso\Http\Controllers;

use Curso\Repositories\TicketRepository;
use Curso\Repositories\VoteRepository;
use Illuminate\Http\Request;
use Curso\Http\Requests;


class VotesController extends Controller
{
    protected $ticketRepository;
    protected $voteRepository;

    public function __construct(TicketRepository $ticketRepository, VoteRepository $voteRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->voteRepository = $voteRepository;
    }

    public function submit($id, Request $request)
    {
        // Comprobamos si el ticket existe o no
        $ticket = $this->ticketRepository->findOrFail($id);
        $success = $this->voteRepository->vote( auth()->user(), $ticket);
        if($request->ajax()){
            return response()->json(['success' => $success]);
        }
        return redirect()->back();
    }

    public function destroy($id, Request $request)
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $success = $this->voteRepository->unvote(auth()->user(), $ticket);
        if($request->ajax()){
            return response()->json(compact('success'));
        }
        return redirect()->back();
    }
}
