<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Room;
use App\Models\Student;
use App\Models\StudentPermit;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Admin
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
            'role_id' => 1,
        ]);
        // Room
        $rooms = [
            ['name' => 'Ruang 1', 'code' => 'R1'],
            ['name' => 'Ruang 2', 'code' => 'R2'],
            ['name' => 'Ruang 3', 'code' => 'R3'],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
        // Class
        $classes = [
            ['name' => 'X', 'code' => 'x'],
            ['name' => 'XI', 'code' => 'xi'],
            ['name' => 'XII', 'code' => 'xii'],
        ];
        foreach ($classes as $class) {
            Classes::create($class);
        }
        // Student
        $students = [
            "Abdullah Faqih Ma'ruf",
            "Abdurrahman Faros Al-hakim",
            "Ghulam Fahry Al-faras",
            "Muhammad Faiz Satrio Gumilang",
            "Muhammad Anabil Faiq",
            "Muhammad Ibrahimovic",
            "Muhammad Ken Izzulhaq",
            "Marvel Arya Al-khaliq",

            "Gunawan Gustav",
            "Aldino Naufal",
            "Al-qaibul Zaky",
            "Fauzan Abdullah Mujahid",
        ];
        foreach ($students as $student) {
            $name = str_replace([" ", "'", "-"], "", strtolower($student));
            $user = User::create([
                'name' => $student,
                'username' => $name,
                'email' => $name . '@example.com',
                'password' => 'password',
                'role_id' => 3,
            ]);
            Student::create([
                'name' => $student,
                'nisn' => fake()->unique()->numberBetween(1000000000, 9999999999),
                'user_id' => $user->id,
                'gender' => 'Laki-laki',
                'birthdate' => fake()->date(),
                'birthplace' => fake()->city(),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ]);
        }
        // Teacher
        $teachers = [
            "Rujian Khairi",
            "Muhammad Rafadyaz Raihan",
            "Rafif Suryaatta",
            "Zainal Fatah",
            "Abdurrazaq Assiddiqi Zuhri",
        ];
        foreach ($teachers as $teacher) {
            $name = str_replace([" ", "'", "-"], "", strtolower($teacher));
            $user = User::create([
                'name' => $teacher,
                'username' => $name,
                'email' => $name . '@example.com',
                'password' => 'password',
                'role_id' => 2,
            ]);
            Teacher::create([
                'name' => $teacher,
                'user_id' => $user->id,
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'gender' => fake()->randomElement(['Laki-laki', 'Perempuan']),
                'birthdate' => fake()->date(),
                'birthplace' => fake()->city(),
            ]);
        }
        for ($i = 1; $i <= 30; $i++) {
            StudentPermit::create([
                'student_id' => rand(1, Student::count()),
                'teacher_id' => rand(1, Teacher::count()),
                'from' => fake()->dateTimeBetween('-1 week', 'now'),
                'to' => fake()->dateTimeBetween('now', '+1 week'),
                'reason' => fake()->realText(70),
                'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            ]);
        }
    }
}
