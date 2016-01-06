<?php
//todo comment file
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
//todo comment class
class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('RolesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('TeamsTableSeeder');
		$this->call('GamesTableSeeder');
		$this->call('LeaguesTableSeeder');
		$this->call('MatchesTableSeeder');
		$this->call('TournamentsTableSeeder');
	}

}
