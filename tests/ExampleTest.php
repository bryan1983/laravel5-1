<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase {

	use DatabaseTransactions;
	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		seed('Tickets');

		$this->assertTrue(true);
	}

}
