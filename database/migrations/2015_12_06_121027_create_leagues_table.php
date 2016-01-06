<?php
//todo comment file
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
//todo comment class
class CreateLeaguesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leagues', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('created_by'); //user id
			$table->foreign('created_by')->references('id')->on('users')->onDelete('restrict');
			$table->integer('game_id');
			$table->foreign('game_id')->references('id')->on('games')->onDelete('cascade'); // really cascade?
			$table->string('name', 70);
			$table->string('abbreviation', 10);
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
		Schema::drop('leagues');
	}

}
