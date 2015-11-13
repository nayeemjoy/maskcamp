<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_reports', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('post_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('report_id')->unsigned();
			$table->timestamps();
			$table->unique(['post_id', 'user_id']);
			$table->foreign('post_id')->references('id')->on('posts');
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('report_id')->references('id')->on('reports');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_reports');
	}

}
