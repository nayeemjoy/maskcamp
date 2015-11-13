<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentlikesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('commentlikes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('comment_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
			$table->unique(['comment_id', 'user_id']);
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('comment_id')->references('id')->on('comments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('commentlikes');
	}

}
