<?php

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 12/09/2015
 * Time: 10:51
 */
use Curso\Entities\User;
use Curso\Entities\UserProfile;
use Styde\Seeder\Seeder;

class UserTableSeeder extends Seeder
{
    public function getModel(){
        return new User;
    }

    public function getDummyData(\Faker\Generator $faker, array $customValues = array())
    {
        return [
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'email' => $faker->unique()->email,
            'password' => bcrypt('123456'),
            'type' => $faker->randomElement(['editor', 'contributor', 'subscriber', 'user'])
        ];
    }

    public function run(){
        $this->createAdmin();
        $this->createMultiple(30);
    }

    private function createAdmin(){
        $this->create([
            'first_name'=> 'Abraham',
            'last_name' => 'Gómez',
            'email'     => 'abri.gomez@gmail.com',
            'password'  => bcrypt('lolailo'),
            'type'      => 'admin'
        ]);

        UserProfile::create([
            'user_id'   => 1,
            'twitter'   => 'http://twitter.com/abrahamgm',
            'website'   => 'http://www.github.com/bryan1984',
            'birthdate' => '1983/06/22',
            'bio'       => 'Usuario administrador'
        ]);
    }
}