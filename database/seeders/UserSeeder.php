<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

    
        User::factory()->create([
            'fullname' => 'test user',
            'email' => 'test@test.com',
            'password' => bcrypt('12345678'),
            'phone' => '0512458792',
            'is_active' => 1,
            'remember_token' => Str::random(10),

        ]);



    }
}



