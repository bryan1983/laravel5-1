<?php
use \Curso\Entities\TicketComment;
use Faker\Generator;
use Styde\Seeder\Seeder;

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 20/03/2016
 * Time: 19:41
 */
class TicketCommentsTableSeeder extends Seeder
{
    public function getModel()
    {
        return new TicketComment();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'comment'   => $faker->paragraph(rand(1, 3)),
            'link'      => $faker->randomElement(['', '', $faker->url]),
            'ticket_id' => $this->random('Ticket')->id,
            'user_id'   => $this->random('User')->id
        ];
    }

    public function run(){
        $this->createMultiple(50);
    }
}