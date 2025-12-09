<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::firstOrCreate(
            ['email' => 'admin@store.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'phone' => '1234567890',
                'address' => 'Admin Address',
                'status' => 'Activo',
                'email_verified_at' => now(),
            ]
        );

        // Client 1
        User::firstOrCreate(
            ['email' => 'client1@store.com'],
            [
                'name' => 'Client One',
                'password' => Hash::make('password'),
                'phone' => '0987654321',
                'address' => 'Client 1 Address',
                'status' => 'Activo',
                'email_verified_at' => now(),
            ]
        );

        // Client 2
        User::firstOrCreate(
            ['email' => 'client2@store.com'],
            [
                'name' => 'Client Two',
                'password' => Hash::make('password'),
                'phone' => '1122334455',
                'address' => 'Client 2 Address',
                'status' => 'Activo',
                'email_verified_at' => now(),
            ]
        );
    }
}
