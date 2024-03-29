<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'amr hamdy',
            'email' => 'amr@yahoo.com',
            'password' => Hash::make('password'),
            'phone_number' => '40004455511111',
        ]);
        User::create([
            'name' => 'aaaaa',
            'email' => 'a@yahoo.com',
            'password' => Hash::make('password'),
            'phone_number' => '30004455511111',
        ]);
        User::create([
            'name' => 'bbbbb',
            'email' => 'b@yahoo.com',
            'password' => Hash::make('password'),
            'phone_number' => '20004455511111',
        ]);
        DB::table('users')->insert([
            'name' => 'cccccc',
            'email' => 'c@yahoo.com',
            'password' => Hash::make('password'),
            'phone_number' => '10004455511111',
        ]);
    }
}
