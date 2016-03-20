<?php
use Curso\Entities\TicketVote;
use Faker\Generator;

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 20/03/2016
 * Time: 19:37
 */
class TicketVotesTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new TicketVote();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'ticket_id' => $this->getRandom('Ticket')->id,
            'user_id'   => $this->getRandom('User')->id
        ];
    }

    public function run()
    {
        $this->createMultiple(30);
    }
}