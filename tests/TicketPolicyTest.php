<?php

use Curso\Policies\TicketPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketPolicyTest extends TestCase
{
    use DatabaseTransactions;

    public function test_author_can_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $policy = new TicketPolicy();

        $this->assertTrue($policy->selectResource($user, $ticket));
    }

    public function test_prevent_users_for_selecting_a_resource_twice()
    {
        $user = seed('User');
        $ticket = seed('Ticket',  [
            'user_id'   => $user->id,
            'status'    => 'closed'
        ]);

        $policy = new TicketPolicy();
        $this->assertFalse($policy->selectResource($user, $ticket));
    }

    public function test_other_users_cannot_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $otherUser = seed('User');

        $policy = new TicketPolicy();

        $this->assertFalse($policy->selectResource($otherUser, $ticket));
    }

    public function test_administrators_can_select_resource()
    {
        $user = seed('User');
        $ticket = seed('Ticket', [
            'user_id' => $user->id
        ]);

        $admin = seed('User', [
            'role' => 'admin'
        ]);

        $this->assertTrue($admin->can('selectResource', $ticket));
        //$this->assertTrue(Gate::forUser($admin)->allows('selectResource', $ticket));
    }

    public function test_administrator_select_two_resources()
    {
        // Having
        $user = seed('User', [
            'role'  => 'admin'
        ]);

        $ticket = seed('Ticket', [
            'user_id'   => $user->id
        ]);

        $comment1 = seed('TicketComments', [
            'ticket_id' => $ticket->id,
            'link'      => 'http://google.com'
        ]);

        $comment2 = seed('TicketComments', [
            'ticket_id' => $ticket->id,
            'link'      => 'http://vallealto.es'
        ]);

        // When
        $ticket->assignResource($comment1->id);
        $ticket->assignResource($comment2->id);

        // Then
        $this->seeInDatabase('tickets', [
            'id'    => $ticket->id,
            'link'  => 'http://vallealto.es'
        ]);

        //dd(\Curso\Entities\TicketComment::all()->toArray());

        $this->seeInDatabase('ticket_comments', [
            'id'        => $comment1->id,
            'selected'  => false
        ]);

        $this->seeInDatabase('ticket_comments', [
            'id'        => $comment2->id,
            'selected'  => true
        ]);
    }
}
