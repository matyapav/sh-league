<?php
//todo comment file
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Match;
//todo comment class
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