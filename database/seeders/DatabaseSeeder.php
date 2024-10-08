<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if (!\App\Models\Admin::exists()) {
            \App\Models\Admin::create([
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'phone_number' => '9999999999',
                'password' => 'password',
            ]);
        }


        $this->call([
            RolesAndPermissionsSeeder::class
        ]);
    }
}
