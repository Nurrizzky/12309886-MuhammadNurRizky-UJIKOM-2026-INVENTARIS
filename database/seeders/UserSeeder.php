<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Wikrama',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => 'admin123',
        ]);

        User::create([
            'name' => 'Staff Wikrama',
            'email' => 'Staff@test.com',
            'role' => 'staff',
            'password' => 'staff123',
        ]);
    }
}
