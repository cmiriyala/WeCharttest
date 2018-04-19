<?php

use Illuminate\Database\Seeder;

class security_questionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Inserting security questions
        DB::table('security_question')->insert([
            [
                'security_question' => 'Your first employer'
            ],
            [
                'security_question' => 'Your mother maiden name'
            ],
            [
                'security_question' => 'Your first car'
            ],
            [
                'security_question' => 'State where you lived at the age of 5'
            ],
            [
                'security_question' => 'Your favourite city'
            ],
            [
                'security_question' => 'Your School best friend name'
            ],
            [
                'security_question' => 'Your favourite holiday destination'
            ]
        ]);
    }
}
