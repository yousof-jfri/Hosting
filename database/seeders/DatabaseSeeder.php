<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('adminadmin'),
            'is_admin' => 1,
            'is_vip' => 1,
        ]);
    }
}
