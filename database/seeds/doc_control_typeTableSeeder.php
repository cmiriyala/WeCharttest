<?php

use Illuminate\Database\Seeder;

class doc_control_typeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Inserting record for radio
        DB::table('doc_control_type')->insert(
            array(
                'control_type' => 'radio',
                'created_by' => 1
            )
        );

        //Inserting record for checkbox
        DB::table('doc_control_type')->insert(
            array(
                'control_type' => 'checkbox',
                'created_by' => 1
            )
        );

        //Inserting record for freetext
        DB::table('doc_control_type')->insert(
            array(
                'control_type' => 'freetext',
                'created_by' => 1
            )
        );


        //Inserting record for dropdown
        DB::table('doc_control_type')->insert(
            array(
                'control_type' => 'dropdown',
                'created_by' => 1
            )
        );


        //Inserting record for searchbar
        DB::table('doc_control_type')->insert(
            array(
                'control_type' => 'searchbar',
                'created_by' => 1
            )
        );
    }
}
