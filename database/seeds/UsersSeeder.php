<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => '212user',
            'email' => 'demo@212.com',
            'password' => bcrypt('@212.com'),
        ]);
    }
}
