<?php

use Illuminate\Database\Seeder;

class freetext_value_typeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Inserting record for number
        DB::table('freetext_value_type')->insert(
            array(
                'freetext_value_type' => 'number',
                'created_by' => 1
            )
        );


        //Inserting record for date
        DB::table('freetext_value_type')->insert(
            array(
                'freetext_value_type' => 'date',
                'created_by' => 1
            )
        );


        //Inserting record for character
        DB::table('freetext_value_type')->insert(
            array(
                'freetext_value_type' => 'character',
                'created_by' => 1
            )
        );
    }
}
