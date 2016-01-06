<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Match;

class MatchesTableSeeder extends Seeder {
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