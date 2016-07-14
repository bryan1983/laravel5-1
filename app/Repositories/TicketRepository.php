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
     * traernos el n�mero de votos de un ticket y el n�mero de comentarios. Esto nos ahorrar�amos
     * dos consultas por ticket en el listado
     *
     * SELECT t.*,
     *  ( SELECT COUNT(*) FROM ticket_commets c WHERE c.ticket_id = t.id ) as num_comments,
     *  ( SELECT COUNT(*) FROM ticket_votes v WHERE v.ticket_id = t.id ) as num_votes
     * FROM tickets t
     * WHERE 1
     */
    protected function getCommentsList(){
      return '( SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id )';
    }

    protected function getVotesList(){
      return '( SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id )';
    }


    protected function selectTicketList()
    {
        return $this->newQuery()->selectRaw(
            'tickets.*, '
            . $this->getCommentsList() . ' as num_comments, '
            . $this->getVotesList() . ' as num_votes'
        )->with('author');
    }

    public function paginateLatest()
    {
        return $this->selectTicketList()
                    ->orderBy('created_at','DESC')
                    ->paginate(5);
    }

    public function paginatePopular()
    {
        return $this->selectTicketList()
                    ->whereRaw($this->getVotesList() . '>= 4')
                    ->orderBy('num_votes', 'DESC')
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