<?php
/**
 * This file contains database migration.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTeamsTable defines db migration for Teams.
 */
class CreateTeamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('captain_id')->unsigned()->index();
			$table->foreign('captain_id')->references('id')->on('users');
			$table->string('name', 70)->unique();
			$table->string('avatar', 100);
			$table->string('abbreviation', 10)->unique();
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
		Schema::drop('teams');
	}

}
