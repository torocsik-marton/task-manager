<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'email' => 'admin@taskmanager.hu',
        ]);

        factory(User::class)->create([
            'email' => 'user@taskmanager.hu',
        ]);
    }
}