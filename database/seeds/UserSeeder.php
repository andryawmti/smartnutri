<?php

use Illuminate\Database\Seeder;
use \App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(array(
            'first_name' => 'Yoona',
            'last_name' => 'Kim',
            'email' => 'yoona.kim@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'birth_date' => '1993-04-15 00:00:00',
            'address' => 'Seoul, South Korea',
            'pregnancy_start_at' => '2018-04-01 10:43:42',
            'blood_type' => 'AB',
            'weight' => '156',
            'api_token' => str_random(60),
        ));
    }
}
