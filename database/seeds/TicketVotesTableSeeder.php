<?php
use Curso\Entities\TicketVote;
use Faker\Generator;
use Styde\Seeder\Seeder;

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 20/03/2016
 * Time: 19:37
 */
class TicketVotesTableSeeder extends Seeder
{
    public function getModel()
    {
        return new TicketVote();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'ticket_id' => $this->random('Ticket')->id,
            'user_id'   => $this->random('User')->id
        ];
    }

    public function run()
    {
        $this->createMultiple(60);
    }
}