<?php

/**
 * Created by PhpStorm.
 * User: Abraham
 * Date: 12/09/2015
 * Time: 10:51
 */

use \Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    public function run(){
        \DB::table('users')->insert(array(
            'first_name'=> 'Abraham',
            'last_name' => 'Gómez',
            'email'     => 'abri.gomez@gmail.com',
            'password'  => \Hash::make('lolailo'),
            'type'      => 'admin'
        ));

        \DB::table('user_profiles')->insert(array(
            'user_id'    => 1,
            'birthdate'  => '1983/06/22'
        ));
    }

}