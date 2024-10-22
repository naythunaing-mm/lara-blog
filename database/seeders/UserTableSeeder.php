<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();
        User::create([
            'id'        => '1',
            'name'      => 'Nay Thu Naing',
            'email'     => 'naythunaing.mm@gmail.com',
            'password'  => Hash::make('password'),
            'phone'     => '09772803152',
            'gender'    => 'male',
            'address'   => '132St, Tamwe Township, Yangon.'
        ]);
    }
}
