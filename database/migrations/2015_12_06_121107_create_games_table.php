<?php
//todo comment file
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//todo comment class
class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 70);
			$table->string('abbreviation', 10);
			$table->string('type', 100);
			$table->string('description', 255);
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
		Schema::drop('games');
	}

}
