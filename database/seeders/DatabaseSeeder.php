<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
         'name' => 'Admin',
         'email' => 'admin@gmail.com',
         'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Admin',
            'phone' => '01770634816',
            'password' => Hash::make('password'),
        ]);
    }
}
