<?php

use Styde\Seeder\BaseSeeder;

class DatabaseSeeder extends BaseSeeder {

	protected $truncate = array(
		'user_profiles',
		'users',
		'password_resets',
		'tickets',
		'ticket_votes',
		'ticket_comments'
	);
	protected $seeders = array(
		'User',
		'UserProfile',
		'Ticket',
		'TicketVotes',
		'TicketComments'
	);
}
