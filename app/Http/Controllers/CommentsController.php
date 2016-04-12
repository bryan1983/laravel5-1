<?php

namespace Curso\Http\Controllers;

use Curso\Entities\TicketComment;
use Curso\Entities\Ticket;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use Curso\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends Controller
{
    public function submit($id, Request $request, Guard $auth)
    {
        // Tenemos que validar el formulario
        $this->validate($request, [
            'comment'   => 'required|max:250',
            'link'      => 'url'
        ]);

        $comment = new TicketComment($request->only(['comment', 'link']));
        $comment->user_id = $auth->id();

        $ticket = Ticket::findOrFail($id);
        $ticket->comments()->save($comment);

        session()->flash('success', 'Tu comentario fue guardado satisfactoriamente');
        return redirect()->back();
    }
}
