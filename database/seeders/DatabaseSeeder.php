<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@example.com',
            'password' => 'superadmin',
            'role_id' => 1,
        ]);
        // Admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin1',
            'email' => 'admin1@example.com',
            'password' => 'admin',
            'role_id' => 2,
        ]);
        User::create([
            'name' => 'Admin 2',
            'username' => 'admin2',
            'email' => 'admin2@example.com',
            'password' => 'admin',
            'role_id' => 2,
        ]);
        if (env('APP_ENV') === 'local') {
            $this->call(TestSeeder::class);
        }
    }
}
