<?php
/**
 * This file contains database migration.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMatchesTable defines db migration for Matches.
 */
class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function(Blueprint $table)
		{
			$table->increments('id')->unsigned();
			$table->integer('team1_id')->unsigned();
			$table->foreign('team1_id')->references('id')->on('teams'); //add ondelete
			$table->integer('team2_id')->unsigned();
			$table->foreign('team2_id')->references('id')->on('teams'); //add ondelete
			$table->integer('prev_match1_id')->nullable()->unsigned();
			$table->foreign('prev_match1_id')->references('id')->on('matches'); //add ondelete
			$table->integer('prev_match2_id')->nullable();
			$table->foreign('prev_match2_id')->references('id')->on('matches'); //add ondelete
			$table->integer('tournament_id')->unsigned();
			$table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade'); //ondelete really cascade?
			$table->boolean('winner');
			$table->integer('level'); //tournament level
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
		Schema::drop('matches');
	}

}
