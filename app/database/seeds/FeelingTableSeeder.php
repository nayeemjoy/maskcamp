<?php 

	class FeelingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('feelings')->delete();
        $feelings = [
        		[
                    'name' => 'None',
        			'created_at' => Carbon::now(),
        			'updated_at' => Carbon::now()
        		],
        		[
        			'name' => 'Happy',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
        		],
        		[
        			'name' => 'Sad',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
        		],
        		[
        			'name' => 'Angry',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
        		],
                [
                    'name' => 'Guilty',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Loved',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Surprised',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]

        ];

        DB::table('feelings')->insert($feelings);
    }

}
