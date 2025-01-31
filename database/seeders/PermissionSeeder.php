<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // ✅ إنشاء الصلاحيات
        Permission::create(['name' => 'create job']);
        Permission::create(['name' => 'edit job']);
        Permission::create(['name' => 'delete job']);
        Permission::create(['name' => 'apply job']);
        Permission::create(['name' => 'manage users']); 

        $admin = Role::where('name', 'admin')->first();
        $employer = Role::where('name', 'employer')->first();
        $candidate = Role::where('name', 'candidate')->first();

        $admin->givePermissionTo(['manage users', 'create job', 'edit job', 'delete job']);
        $employer->givePermissionTo(['create job', 'edit job', 'delete job']);
        $candidate->givePermissionTo(['apply job']);
    }
}
