<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_answers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('option_id')->unsigned();
			$table->timestamps();
			$table->unique(['user_id', 'option_id']);
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('option_id')->references('id')->on('question_options');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_answers');
	}

}
