<?php
//todo comment file
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Role;
//todo comment class
class RolesTableSeeder extends Seeder {

    /**
     * Fills roles table
     *
     */
    public function run()
    {
       Role::create([
           'name' => 'admin',
           'description' => 'admin role'
       ]);

    }
}