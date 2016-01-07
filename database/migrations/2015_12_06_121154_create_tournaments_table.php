<?php
/**
 * This file contains database migration.
 */
namespace database\migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTournamentsTable defines db migration for Tournaments.
 */
class CreateTournamentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tournaments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('league_id')->unsigned()->index();
			$table->foreign('league_id')->references('id')->on('leagues')->onDelete('cascade'); // really cascade?
			$table->integer('min_number_of_teams');
			$table->integer('max_number_of_teams');
			$table->date('start_date');
			$table->date('end_date');
			$table->string('name', 80)->unique();
			$table->string('type', 100);
			$table->string('description');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tournaments');
	}

}
