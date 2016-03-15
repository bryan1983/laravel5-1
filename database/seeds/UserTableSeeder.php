<?php

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 12/09/2015
 * Time: 10:51
 */

use \Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    public function run(){

        // use the factory to create a Faker\Generator instance
        $faker = Faker::create();

        for($i = 0; $i < 30; $i++) {


            $id = \DB::table('users')->insertGetId(array(
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email,
                'password' => \Hash::make('123456'),
                'type' => $faker->randomElement(['editor','contributor','subscriber','user'])
            ));

            \DB::table('user_profiles')->insert(array(
                'user_id'   => $id,
                'bio'       => $faker->paragraph(rand(2, 4)),
                'twitter'   => 'http://twitter.com/' . $faker->userName,
                'website'   => 'http://www.'. $faker->domainName,
                'birthdate' => $faker->dateTimeBetween('-45 years', '-15 years')->format('Y-m-d')
            ));

        }
    }

}