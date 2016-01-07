<?php
/**
 * This file contains database seeder for Roles.
 */
namespace database\seeds;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Role;

/**
 * Class RolesTableSeeder creates Roles and save them into database.
 */
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