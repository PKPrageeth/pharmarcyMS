<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'address' => "Colombo 5",
            'contact' => "0771234567",
            'dob' => "1991-11-30",
            'role' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'nimal',
            'email' => 'nimal@gmail.com',
            'password' => Hash::make('12345678'),
            'address' => "Colombo 5",
            'contact' => "0771234567",
            'dob' => "1991-11-30",
            'role' => 0,
        ]);
    }
}
