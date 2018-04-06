<?php

use Illuminate\Database\Seeder;

class patient_record_statusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('patient_record_status')->insert(
            array(
                'patient_record_status' => 'saved',
                'created_by' => 1
            )
        );

        //Inserting record for submitted for review
        DB::table('patient_record_status')->insert(
            array(
                'patient_record_status' => 'submitted for review',
                'created_by' => 1
            )
        );

        //Inserting record for reviewed
        DB::table('patient_record_status')->insert(
            array(
                'patient_record_status' => 'reviewed',
                'created_by' => 1
            )
        );
    }
}
