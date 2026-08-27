<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Dev',
            'surname' => 'Tester',
            'role' => 'Developer',
            'email' => 'testdev@example.com',
            'admin' => true,
        ]);

        User::factory()->create([
            'name' => 'Test',
            'surname' => 'User',
            'role' => 'Intern',
            'email' => 'testuser@example.com',
            'admin' => false,
        ]);

        User::factory(18)->create();
    }
}
