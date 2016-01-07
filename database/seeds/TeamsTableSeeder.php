<?php
/**
 * This file contains database seeder for Teams.
 */
namespace database\seeds;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Team;
/**
 * Class TeamsTableSeeder creates Teams using Faker and save them into database.
 */
class TeamsTableSeeder extends Seeder {

    /**
     * Fills teams table
     *
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            Team::create([
                'name' => $faker->name(),
                'abbreviation' => $faker->lastName(),
                'description' => $faker->realText(150)
            ]);
        }
    }
}