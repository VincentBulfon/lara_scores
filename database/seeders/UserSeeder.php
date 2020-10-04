<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $users =
        [
            ['name' => 'Vincent Bulfon',
                'email' => 'vincent.bulfon@gmail.com',
                'password' => Hash::make('rootroot')],
            ['name' => 'Toto Tata',
                'email' => 'toto.tata@gmail.com',
                'password' => Hash::make('rootroot')],
            ['name' => 'Third user',
                'email' => '3rd@gmail.com',
                'password' => Hash::make('rootroot')]
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
