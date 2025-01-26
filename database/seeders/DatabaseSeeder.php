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
        User::create([
            'email' => 'passenger@moon.ru',
            'password' => 'P@rtyAstr0nauts'
        ]);
        User::create([
            'email' => 'passenger@mars.ru',
            'password' => 'QwertyP@rtyAstr0nauts'
        ]);
    }
}
