<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin ',
            'email' => 'Ahmed@gmail.com',
            'password' => Hash::make('password123'), // Use a secure password
            'admin' => true, // Ensure this field exists in your database
        ]);
    }
}
