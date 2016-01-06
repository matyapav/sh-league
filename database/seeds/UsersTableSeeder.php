<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
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

        $admin = User::create([
            'nickname' => 'admin',
            'email' => 'matyapav@fel.cvut.cz',
            'city' => 'Praha',
            'state' => 'Czech Republic',
            'birthdate' => $faker->date(),
            'name' => 'Pavel Matyáš',
            'info' => $faker->realText(100),
            'password' => Hash::make('password')
        ]);
        $admin->roles()->attach(1);
    }
}