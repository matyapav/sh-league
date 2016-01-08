<?php
/**
 * This file contains database seeder for Users.
 */

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\User;
/**
 * Class UsersTableSeeder creates Users using Faker and save them into database.
 */
class UsersTableSeeder extends Seeder {

    /**
     * Fills users table
     *
     */
    public function run()
    {


        $faker = Faker::create();
	  $admin = User::create([
            'nickname' => 'admin',
            'email' => 'matyapav@fel.cvut.cz',
            'city' => 'Praha',
            'state' => 'Czech Republic',
            'birthdate' => $faker->date(),
            'name' => 'Pavel Matyas',
            'info' => $faker->realText(100),
            'password' => Hash::make('password')
        ]);
        $admin->roles()->attach(1);

        foreach(range(1, 10) as $index)
        {
            User::create([
                'nickname' => $faker->name(),
                'email' => $faker->email(),
                'city' => $faker->city(),
                'state' => $faker->city(),
                'birthdate' => $faker->date(),
                'name' => $faker->name(),
                'info' => $faker->realText(100),
                'password' => Hash::make('password')
            ]);
        }
        $user = User::create([
            'nickname' => 'matyapav',
            'email' => 'matyaspaul@yahoo.com',
            'city' => 'Praha',
            'state' => 'Czech Republic',
            'birthdate' => $faker->date(),
            'name' => 'Pavel Matyáš',
            'info' => $faker->realText(100),
            'password' => Hash::make('password')
        ]);
    }
}