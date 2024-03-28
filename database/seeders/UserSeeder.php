<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'name' => 'John',
            'email' => Str::random(10) . '@example.com',
            'password' => Hash::make('password'),
        ]);

        $user2 = User::create([
            'name' => 'Abdullol',
            'email' => Str::random(10) . '@example.com',
            'password' => Hash::make('password'),
        ]);

        // User::factory(10)->create();

        $user->roles()->attach([1, 3]);
        $user2->roles()->attach([2]);
    }
}
