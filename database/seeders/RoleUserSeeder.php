<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'vincent.bulfon@gmail.com')->first();
        $user->roles()->attach(Role::where('name', 'team-manager')->first()->id);

        $user = User::where('email', 'vincent.bulfon@gmail.com')->first();
        $user->roles()->attach(Role::where('name', 'admin')->first()->id);

        $user = User::where('email', 'toto.tata@gmail.com')->first();
        $user->roles()->attach(Role::where('name', 'team-manager')->first()->id);
    }
}
