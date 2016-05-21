<?php
namespace Curso\Repositories;
use Curso\Entities\Ticket;
use Curso\Entities\TicketComment;

class TicketRepository extends BaseRepository
{

    public function getModel()
    {
        return new Ticket();
    }

    /**
     * Utilizamos subconsultas SQL para optimizar las llamadas SQL que realiza el ORM a la hora de
     * traernos el número de votos de un ticket y el número de comentarios. Esto nos ahorraríamos
     * dos consultas por ticket en el listado
     *
     * SELECT t.*,
     *  ( SELECT COUNT(*) FROM ticket_commets c WHERE c.ticket_id = t.id ) as num_comments,
     *  ( SELECT COUNT(*) FROM ticket_votes v WHERE v.ticket_id = t.id ) as num_votes
     * FROM tickets t
     * WHERE 1
     */
    protected function selectTicketList()
    {
        return $this->newQuery()->selectRaw(
            'tickets.*, '
            . ' ( SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id ) as num_comments, '
            . ' ( SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id ) as num_votes'
        )->with('author');
    }

    public function paginateLatest()
    {
        return $this->selectTicketList()
                    ->orderBy('created_at','DESC')
                    ->paginate(5);
    }

    public function paginateOpen()
    {
        return $this->selectTicketList()
                    ->where('status', 'open')
                    ->paginate(5);
    }

    public function paginateClosed()
    {
        return $this->selectTicketList()
                    ->where('status', 'closed')
                    ->paginate(5);
    }

    public function openNew($user, $title, $link = '')
    {
         return $user->tickets()->create([
             'title'     =>  $title,
             'link'      => $link,
             'status'    => ($link ? 'closed' : 'open')
        ]);
    }

}