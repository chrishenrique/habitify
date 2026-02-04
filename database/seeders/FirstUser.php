<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(['email' => 'test@example.com',], [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => '1234',
        ]);
    }
}
