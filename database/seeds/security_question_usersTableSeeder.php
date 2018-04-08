<?php

use Illuminate\Database\Seeder;

class security_question_usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('security_question_users')->insert(
            array(
                ['security_question_id' => 1,
                    'user_id' => 1,
                    'security_question_answer' => 'unmc'],
                ['security_question_id' => 4,
                    'user_id' => 1,
                    'security_question_answer' => 'texas'],
                ['security_question_id' => '5',
                    'user_id' => 1,
                    'security_question_answer' => 'omaha']
            )
        );
    }
}
