<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run role seeder first
        $this->call(RoleSeeder::class);
        
        // Run product seeder
        $this->call(ProductSeeder::class);

        // Create admin user
        $adminRole = Role::where('name', 'admin')->first();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@coffee.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        // Create test customer
        $customerRole = Role::where('name', 'customer')->first();
        User::create([
            'name' => 'Customer Test',
            'email' => 'customer@coffee.com',
            'password' => bcrypt('password'),
            'role_id' => $customerRole->id,
        ]);
    }
}
