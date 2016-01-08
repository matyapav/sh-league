<?php
/**
 * This file contains database seeder for Leagues
 */

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\League;
use App\Game;
/**
 * Class LeaguesTableSeeder creates Leagues using Faker and save them into database.
 */
class LeaguesTableSeeder extends Seeder {

    /**
     * Fills leagues table
     *
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            $l = League::create([
                'name' => $faker->name(),
                'abbreviation'=>$faker->realText(10),
                'description' => $faker->realText(150)
            ]);
            $l->game()->associate(Game::first())->save(); //associate league with first game
        }
    }
}