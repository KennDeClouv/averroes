<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'code' => 'admin'],
            ['name' => 'Ustadz', 'code' => 'teacher'],
            ['name' => 'Santri', 'code' => 'student'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
