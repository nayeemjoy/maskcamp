<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHashTaggedPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hash_tagged_posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('post_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			$table->timestamps();
			$table->unique(['post_id', 'tag_id']);
			$table->foreign('post_id')->references('id')->on('posts');
			$table->foreign('tag_id')->references('id')->on('hashtags');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('hash_tagged_posts');
	}

}
