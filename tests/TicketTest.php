<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class TicketTest extends TestCase {

	use DatabaseTransactions;
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function test_create_ticket()
	{
		// Having
        $user = seed('User');

        // Where
        $this->actingAs($user)
            ->visit(route('tickets.create'))
            ->type('Curso de VueJS', 'title')
            ->press('Enviar Solicitud')
        ;

        //Then
        $this->see('Curso de VueJS');

        $this->seeInDatabase('tickets', [
            'title'     => 'Curso de VueJS',
            'status'    => 'open'
        ]);

	}

}
