<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Pengguna Biasa',
            'username' => 'user',
            'email' => 'user@mail.com',
            'password' => bcrypt('password'),
            'nohp' => '08123456789',
            'role' => 0,
            'active' => 1,
            'foto_profil' => ''
        ]);


        User::create([
            'name' => 'Pemilik Bisnis',
            'username' => 'owner',
            'email' => 'owner@mail.com',
            'password' => bcrypt('password'),
            'nohp' => '08765432100',
            'role' => 1,
            'active' => 1,
            'foto_profil' => ''
        ]);


        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'nohp' => '08555555555',
            'role' => 2,
            'active' => 1,
            'foto_profil' => ''
        ]);
    }
}
