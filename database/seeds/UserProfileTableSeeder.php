<?php
use Curso\Entities\UserProfile;
use Faker\Generator;

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 20/03/2016
 * Time: 19:12
 */
class UserProfileTableSeeder extends BaseSeeder
{

    public function getModel()
    {
        return new UserProfile();
    }

    public function getDummyData(Generator $faker, array $customValues = array())
    {
        return [
            'user_id' => $this->getRandom('User')->id,
            'bio' => $faker->paragraph(rand(2, 4)),
            'twitter' => 'http://twitter.com/' . $faker->userName,
            'website' => 'http://www.' . $faker->domainName,
            'birthdate' => $faker->dateTimeBetween('-45 years', '-15 years')->format('Y-m-d')
        ];
    }

    public function run()
    {
        $this->createMultiple(30);
    }
}