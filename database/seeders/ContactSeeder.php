<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ContactSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\Contactus::create([
            'facebook_link' => "https://www.linkedin.com/",
            'insta_link' => "https://www.linkedin.com/",
            'snap_link' => "https://www.linkedin.com/",
            'whatsapp' => "01061845321",
            'new_phone' => "01067879653",
            'created_at' => now()->addDay(rand(1, 6)),
            'updated_at' => now()->addDay(rand(1, 6)),
        ]);



    }
}
