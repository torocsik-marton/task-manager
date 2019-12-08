<?php

use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        Role::find(1)
            ->permissions()
            ->sync([1, 2]);

        Role::find(2)
            ->permissions()
            ->sync([1]);
    }
}