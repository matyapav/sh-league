<?php
//todo comment file
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Tournament;
//todo comment class
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
            Tournament::create([
                'name' => $faker->name(),
                'min_number_of_teams' => $faker->numberBetween(2,4),
                'max_number_of_teams' => $faker->numberBetween(4,16),
                'start_date' => $faker->date('YYYY-MM-DD'),
                'end_date' => $faker->date('YYYY-MM-DD'),
                'type' => $faker->realText(100),
            ]);
        }
    }
}