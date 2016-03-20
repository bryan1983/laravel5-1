<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->truncateTables(array(
			'user_profiles',
			'users',
			'password_resets',
			'tickets',
			'ticket_votes',
			'ticket_comments'
		));

		$this->call('UserTableSeeder');
		$this->call('UserProfileTableSeeder');
		$this->call('TicketsTableSeeder');
		$this->call('TicketVotesTableSeeder');
		$this->call('TicketCommentsTableSeeder');
	}

	public function truncateTables(array $tables)
	{
		$this->checkForeignKey(false);

		foreach ($tables as $table) {
			DB::table($table)->truncate();
		}

		$this->checkForeignKey(true);
	}

	public function checkForeignKey($check)
	{
		$check = $check ? '1' : '0';
		DB::statement("SET FOREIGN_KEY_CHECKS = $check;");
	}

}
