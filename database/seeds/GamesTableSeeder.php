<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Game;

class GamesTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            Game::create([
                'name' => $faker->name(),
                'abbreviation' => $faker->realText(10),
                'type' => $faker->realText(100),
                'description'=> $faker->realText(255)
            ]);
        }
    }
}