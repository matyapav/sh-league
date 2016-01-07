<?php
/**
 * This file contains database seeder for Matches.
 */
namespace database\seeds;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Match;
/**
 * Class MatchesTableSeeder creates Matches using Faker and save them into database. Not implemented yet.
 */
class MatchesTableSeeder extends Seeder {

    /**
     * Fills matches table
     *
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            Match::create([
            ]);
        }
    }
}