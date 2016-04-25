<?php

namespace Curso\Http\Controllers;

use Curso\Entities\TicketComment;
use Curso\Entities\Ticket;
use Curso\Repositories\CommentRepository;
use Curso\Repositories\TicketRepository;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Curso\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{

    protected $commentRepository;
    protected $ticketRepository;

    public function __construct(CommentRepository $commentRepository, TicketRepository $ticketRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->ticketRepository = $ticketRepository;
    }

    /*protected function selectCommentUser()
    {
        return TicketComment::selectRaw(

        );
    }*/

    public function submit($id, Request $request, Guard $auth)
    {
        // Tenemos que validar el formulario
        $this->validate($request, [
            'comment'   => 'required|max:250',
            'link'      => 'url'
        ]);

        $ticket = $this->TicketRepository->findOrFail($id);

        $this->CommentRepository->create(
            $ticket,
            $auth->id(),
            $request->get('comment'),
            $request->get('link')
        );

        session()->flash('success', 'Tu comentario fue guardado satisfactoriamente');
        return redirect()->back();
    }
}
