<?php
//todo comment file
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Team;
//todo comment class
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