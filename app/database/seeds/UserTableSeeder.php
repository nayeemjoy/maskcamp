<?php 

	class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        $users = [
        		[
        			'user_id' => '3214',
        			'sex' => 'male',
        			'email' => 'joy_bd1@yahoo.com',
        			'created_at' => Carbon::now(),
        			'updated_at' => Carbon::now()
        		],
        		[
        			'user_id' => '34334',
        			'sex' => 'female',
        			'email' => 'joy_bd1@yahoo.com',
        			'created_at' => Carbon::now(),
        			'updated_at' => Carbon::now()
        		],
        		[
        			'user_id' => '3343',
        			'sex' => 'male',
        			'email' => 'joy_bd1@yahoo.com',
        			'created_at' => Carbon::now(),
        			'updated_at' => Carbon::now()
        		],
        		[
        			'user_id' => '3363',
        			'sex' => 'female',
        			'email' => 'joy_bd1@yahoo.com',
        			'created_at' => Carbon::now(),
        			'updated_at' => Carbon::now()
        		]

        ];

        DB::table('users')->insert($users);
    }

}
