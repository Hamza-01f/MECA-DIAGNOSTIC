<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $RHmanager = Role::create(['name' => 'RHmanager']);
        $manager = Role::create(['name' => 'manager']);
        $employee = Role::create(['name' => 'employee']);

        $permission = ['create-post', 'edit-post', 'delete-post'];




    }
}
