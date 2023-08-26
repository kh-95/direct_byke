<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Admin::create([
            'fullname' => "Admin",
            'login_id' => "123456",
            'phone' => "123456789",
            'email' => "admin@directbyke.com",
            'is_active' => 1,
            'email_verified_at' => now()->addDay(rand(1, 6)),
            'phone_verified_at' => now()->addDay(rand(1, 6)),
            'password' => Hash::make('&&#$%'), // secret
            'user_type' => 'superadmin', // secret
        ]);



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
