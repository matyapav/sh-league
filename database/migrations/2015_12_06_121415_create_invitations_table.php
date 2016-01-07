<?php
/**
 * This file contains database migration.
 */
namespace database\migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateInvitationsTable defines db migration for invitations pivot table between User and Team tables.
 */
class CreateInvitationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invitations', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->integer('team_id');
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
		Schema::drop('invitations');
	}

}
