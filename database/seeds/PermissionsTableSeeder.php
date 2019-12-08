<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        Permission::create([
            'permission' => 'complete_own_task'
        ]);

        Permission::create([
            'permission' => 'complete_any_task'
        ]);
    }
}