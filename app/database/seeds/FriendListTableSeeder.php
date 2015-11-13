<?php 

	class FriendListTableSeeder extends Seeder {

    public function run()
    {
        DB::table('friend_list')->delete();
        $friends = [
        		[
        			'user_id' => '1',
        			'friend_id' => '2',
        			'created_at' => Carbon::now(),
        			'updated_at' => Carbon::now()
        		],
                [
                    'user_id' => '1',
                    'friend_id' => '3',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'user_id' => '1',
                    'friend_id' => '4',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'user_id' => '2',
                    'friend_id' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'user_id' => '2',
                    'friend_id' => '3',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                 [
                    'user_id' => '2',
                    'friend_id' => '4',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                 [
                    'user_id' => '3',
                    'friend_id' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                 [
                    'user_id' => '3',
                    'friend_id' => '2',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
        		

        ];

        DB::table('friend_list')->insert($friends);
    }

}
