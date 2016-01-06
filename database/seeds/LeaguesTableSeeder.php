<?php
//todo comment file
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\League;
//todo comment class
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
            League::create([
                'name' => $faker->name(),
                'abbreviation'=>$faker->realText(10),
                'description' => $faker->realText(150)
            ]);
        }
    }
}