<?php
/**
 * This file contains database migration.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTeamMembersTable defines db migration for team_members pivot table between Team and User tables.
 */
class CreateTeamMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('team_members', function(Blueprint $table)
		{

			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->integer('team_id')->unsigned()->index();
			$table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

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
		Schema::drop('team_members');
	}

}
