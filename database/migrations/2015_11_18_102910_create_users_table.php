<?php
/**
 * This file contains database migration.
 */


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable defines db migration for Users.
 */
class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nickname', 70)->unique();
			$table->string('avatar', 100)->nullable();
			$table->string('email')->unique();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->date('birthdate')->nullable();
			$table->string('name', 80)->nullable();
			$table->string('info')->nullable();
			$table->string('password', 60);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
