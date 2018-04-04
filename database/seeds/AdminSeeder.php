<?php

use Illuminate\Database\Seeder;
use \App\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create(array(
            'first_name' => 'Andrya',
            'last_name' => 'Olivera',
            'email' => 'andryavera@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'birth_date' => '1993-04-15 00:00:00',
            'address' => 'Mountain View, California',
            'api_token' => str_random(60),
        ));
    }
}
