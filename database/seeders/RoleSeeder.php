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
            ['name' => 'Super Admin', 'code' => 'super_admin'],
            ['name' => 'Admin Administrasi', 'code' => 'administration_admin'],
            ['name' => 'Ustadz', 'code' => 'teacher'],
            ['name' => 'Santri', 'code' => 'student'],
            ['name' => 'Calon Santri', 'code' => 'student_registrant'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
