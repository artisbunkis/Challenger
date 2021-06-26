<?php

namespace Database\Seeders;

use App\Models\Challenge;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Eloquent::unguard();
        //$this->call('UserTableSeeder');
        // \App\Models\User::factory(10)->create();

        //ADMIN USER SEEDER
        User::create([
            'Email' => 'admin@gmail.com',
            'Username' => 'admin',
            'Password' => bcrypt('adminpassword'),
            'Gender_ID' => '0',
            'FirstName' => 'Admin',
            'LastName' => 'Profile',
            'BirthDate' => '2000-09-27',
            'remember_token' => Str::random(10),
            'role' => 1
        ]);

        User::create([
            'Email' => 'archy@gmail.com',
            'Username' => 'archy',
            'Password' => bcrypt('password'),
            'Gender_ID' => '0',
            'FirstName' => 'Artis',
            'LastName' => 'Bunkis',
            'BirthDate' => '2000-09-27',
            'remember_token' => Str::random(10),
            'role' => 0
        ]);

        User::create([
            'Email' => 'ricards@gmail.com',
            'Username' => 'richZ',
            'Password' => bcrypt('password'),
            'Gender_ID' => '0',
            'FirstName' => 'Ricards',
            'LastName' => 'Zvagulis',
            'BirthDate' => '2000-01-01',
            'remember_token' => Str::random(10),
            'role' => 0
        ]);
        
    }
}
