<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelHasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SuperAdmin = \App\Models\Admin::where('user_type', 'superadmin')->first();
        $SuperAdmin->assignRole('Super Admin');
    }
}
