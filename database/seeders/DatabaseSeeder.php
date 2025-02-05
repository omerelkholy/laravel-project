<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {



        $this->call(
            PermissionSeeder::class,
        );

        Role::create([
            'name' => 'employer',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'candidate',
            'guard_name' => 'web',
        ]);
        // User::factory(10)->create()
        User::factory(1)->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'role' => 'candidate',
            'password' => Hash::make('testtest'),
        ]);
        $cand = User::where('email', 'test@test.com')->first();
        $cand->givePermissionTo(['apply job']);

        $cand->assignRole('candidate');
        $emp =  User::factory(1)->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'role' => 'employer',
            'password' => Hash::make('testtest'),
        ]);
        $emp = User::where('email', 'test@gmail.com')->first();
        $emp->givePermissionTo(['create job', 'edit job', 'delete job']);
        $emp->assignRole('employer');
        $this->call([
            JobListingSeeder::class,
            // Add other seeders here if necessary
        ]);
    }
}
