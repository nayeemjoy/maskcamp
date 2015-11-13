<?php 

	class ReportTableSeeder extends Seeder {

    public function run()
    {
        DB::table('reports')->delete();
        $posts = [
        		[
        			'name' => 'Hate Speech',
        			'details' => 'Hate Speech',
                    'created_at' => Carbon::now(),
        			'updated_at' => Carbon::now()
        		],
                [
                    'name' => 'Offensive',
                    'details' => 'Offensive',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Threat',
                    'details' => 'Threat',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]


        ];

        DB::table('reports')->insert($posts);
    }

}
