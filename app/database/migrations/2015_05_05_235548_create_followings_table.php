<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('followings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('follower_id')->unsigned();
			$table->integer('following_id')->unsigned();
			$table->timestamps();
			$table->unique(['follower_id', 'following_id']);
			$table->foreign('follower_id')->references('id')->on('users');
			$table->foreign('following_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('followings');
	}

}
