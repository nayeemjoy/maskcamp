<?php 

	class QuestionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('questions')->delete();
        $users = [
        		[
        			'question' => 'How long do you sleep everyday',
        			'created_at' => '2015-04-24',
        			'updated_at' => Carbon::now()
        		]
        ];

        DB::table('questions')->insert($users);
         $users = [
                [
                    'question_id' => '1',
                    'option_number' => '1',
                    'option_details' => '10H',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                 [
                    'question_id' => '1',
                    'option_number' => '2',
                    'option_details' => '12H',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                 [
                    'question_id' => '1',
                    'option_number' => '3',
                    'option_details' => '14H',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
        ];
        DB::table('question_options')->insert($users);
    }

}
