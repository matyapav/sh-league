<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\League;

class LeaguesTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1, 10) as $index)
        {
            League::create([
                'name' => $faker->name(),
                'abbreviation'=>$faker->realText(10),
                'description' => $faker->realText(150)
            ]);
        }
    }
}