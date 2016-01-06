<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder {

    public function run()
    {
       Role::create([
           'name' => 'admin',
           'description' => 'admin role'
       ]);

       Role::create([
           'name' => 'team-leader',
           'description' => 'leader of the team'
       ]);

    }
}