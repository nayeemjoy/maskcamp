<?php 

	class PostTableSeeder extends Seeder {

    public function run()
    {
        DB::table('posts')->delete();
        $posts = [
        		[
        			'user_id' => '1',
        			'post' => 'lol',
                    'feeling' => '2',
                    'type' => '0',
        			'created_at' => Carbon::now(),
        			'updated_at' => Carbon::now()
        		],
                [
                    'user_id' => '2',
                    'post' => 'রাজাকারের ফাসি চাই',
                    'feeling' => '2',
                    'type' => '0',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'user_id' => '3',
                    'post' => 'The Third User. Friendless but followed.',
                    'feeling' => '1',
                    'type' => '1',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]

        ];

        DB::table('posts')->insert($posts);
    }

}
