<?php

namespace Curso\Repositories;


use Curso\Entities\Ticket;
use Curso\Entities\TicketComment;
use Curso\Entities\User;

class CommentRepository extends BaseRepository
{
    public function getModel()
    {
        return new TicketComment();
    }

    /*protected function selectCommentList()
    {
        return $this->newQuery()->selectRaw(
            'ticket_comments.*, CONCAT(users.first_name, " ", users.last_name) as name_user'.
            'INNER JOIN users ON users.id = ticket_comments.user_id'
        )->with('user');
    }*/

    public function create(Ticket $ticket,User $user, $comment, $link = "")
    {
        $comment = new TicketComment(compact('comment', 'link'));
        $comment->user_id = $user->id;
        $ticket->comments()->save($comment);
    }
}