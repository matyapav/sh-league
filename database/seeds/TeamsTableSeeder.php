<?php
/**
 * This file contains database seeder for Teams.
 */

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Team;
use App\User;
/**
 * Class TeamsTableSeeder creates Teams using Faker and save them into database.
 */
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
            $t = Team::create([
                'name' => $faker->name(),
                'abbreviation' => $faker->realText(11),
                'description' => $faker->realText(150)
            ]);
		$t->captain()->associate(User::first());
		$t->members()->attach(User::first());//set captain of all teams to first user
		$t->save();
        }
    }
}