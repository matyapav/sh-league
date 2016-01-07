<?php
/**
 * This file contains database seeder for Tournaments.
 */
namespace database\seeds;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Tournament;
/**
 * Class TournamentsTableSeeder creates Tournaments using Faker and save them into database.
 */
class TournamentsTableSeeder extends Seeder {

    /**
     * Fills tournaments table
     *
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            $t = Tournament::create([
                'name' => $faker->name(),
                'min_number_of_teams' => $faker->numberBetween(2,4),
                'max_number_of_teams' => $faker->numberBetween(4,16),
                'start_date' => $faker->date('YYYY-MM-DD'),
                'end_date' => $faker->date('YYYY-MM-DD'),
                'type' => $faker->realText(100),
            ]);
            $t->league()->associate(League::first()); //associate tournamnet with first league

        }
    }
}