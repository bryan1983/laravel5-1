<?php

use Curso\Entities\Ticket;
use Faker\Generator;

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 20/03/2016
 * Time: 17:35
 */
class TicketsTableSeeder extends BaseSeeder
{
    public function getModel()
    {
        return new Ticket();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'title' => $faker->sentence(),
            'status' => $faker->randomElement(['open', 'open', 'closed']),
            'user_id' => $this->getRandom('User')->id
        ];
    }

    public function run()
    {
        $this->createMultiple(40);
    }
}