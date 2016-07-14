<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PopularTicketTest extends TestCase
{
    use DatabaseTransactions;

    public function test_see_popular_tickets()
    {

      $popularTicket = seed('Ticket', ['title' => 'Ticket más popular']);
      $ticket = seed('Ticket', ['title' => 'Ticket menos popular']);

      seed('TicketVotes', 10, ['ticket_id' => $popularTicket->id]);
      seed('TicketVotes', 1, ['ticket_id' => $ticket->id]);

      $this->visit('/')
            ->click('Populares')
            ->seeInElement('h1', 'Solicitudes populares')
            ->see($popularTicket->title)
            ->see('10 Votos')
            ->dontSee($ticket->title)
            ->dontSee('1 Voto');
    }
}
