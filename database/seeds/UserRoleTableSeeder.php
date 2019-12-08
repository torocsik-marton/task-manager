<?php

use App\User;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    public function run()
    {
        User::find(1)
            ->roles()
            ->sync([1, 2]);

        User::find(2)
            ->roles()
            ->sync([2, 2]);
    }
}