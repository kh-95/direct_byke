<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('general_settings')->insert([
            'price_per_minute' => 0,
            'vat' => 0,
            'pre_end_warning' => 0,
            'tax' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
