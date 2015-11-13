<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('FeelingTableSeeder');
		$this->call('FriendListTableSeeder');
		//$this->call('FollowingTableSeeder');
		$this->call('PostTableSeeder');
		$this->call('QuestionTableSeeder');
		$this->call('ReportTableSeeder');
	}

}
