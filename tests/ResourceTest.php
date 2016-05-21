<?php
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 15/05/2016
 * Time: 20:14
 */
class ResourceTest extends TestCase
{
    use DatabaseTransactions;

    protected $title = 'Curso de Eloquent Avanzado';
    protected $link = 'http://google.es';

    public function test_create_resource()
    {
        // Having
        $user = seed('User');

        //Where
        $this->actingAs($user)
            ->visit(route('tickets.create'))
            ->type($this->title,'title')
            ->type($this->link, 'link')
            ->press('Enviar Solicitud');

        //Then
        $this->seeInDatabase('tickets', [
            'title' => $this->title,
            'link'  => $this->link,
            'status'=> 'closed'
        ]);

        $this->see($this->title)
            ->seeLink('Ver recurso', $this->link);
    }

    public function test_select_resource()
    {
        // Having
        $user = seed('User');

        $ticket = seed('Ticket', [
            'title'     => $this->title,
            'user_id'   => $user->id,
            'status'    => 'open'
        ]);

        $comment = seed('TicketComments', [
            'ticket_id' => $ticket->id,
            'link'      => $this->link
        ]);

        // Where
        $this->actingAs($user)
            ->visit(route('tickets.details', $ticket))
            ->press('Seleccionar tutorial')
        ;

        // Then
        $this->seeInDatabase('tickets', [
            'id' => $ticket->id,
            'status'    => 'closed',
            'link'      => $this->link
        ]);

        $this->seeInDatabase('ticket_comments', [
            'ticket_id' => $ticket->id,
            'selected'  => true
        ]);

        $this->seePageIs(route('tickets.details', $ticket));

        $this->seeLink('Ver recurso', $this->link);
    }
}