<?php
/**
 * This file contains database migration.
 */
namespace database\migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUserRolesTable defines db migration for user_roles pivot table bewtween User and Role tables.
 */
class CreateUserRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_roles', function(Blueprint $table)
		{
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('role_id')->unsigned();
			$table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
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
		Schema::drop('user_roles');
	}

}
