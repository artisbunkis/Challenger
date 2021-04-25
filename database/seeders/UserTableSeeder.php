<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Hash;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'Email' => 'artis.gylmore@gmail.com',
            'Username' => 'archy',
            'Password' => bcrypt('password'),
            'Gender_ID' => '0',
            'FirstName' => 'Artis',
            'LastName' => 'Bunkis',
            'BirthDate' => '2000-09-27',
            'remember_token' => Str::random(10),
        ]);
    }
}

// User_ID 	Email 	Username 	Password 	Gender_ID 	FirstName 	LastName 	BirthDate 	remember_token