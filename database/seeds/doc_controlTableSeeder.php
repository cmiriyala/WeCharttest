<?php

use Illuminate\Database\Seeder;

class doc_controlTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Insert records for History of Present Illness
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 1,           //History of Present Illness
                'label' => 'History of Present Illness',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 1,           //History of Present Illness
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        //Insert records for Personal History
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 3,           //Personal History
                'label' => 'Diagnosis History',
                'doc_control_type_id' => 5,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'lookup_table_used' => 'diagnosis_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 3,           //Personal History
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        //Insert records for Family History
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 4,           //Family History
                'label' => 'Family Member',
                'doc_control_type_id' => 3,     //Freeform text
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'doc_control_group' => 1,       //Group 1
                'doc_control_group_order' => 1, //Group order 1
                'created_by' => 1               //admin
            )
        );
        //Insert records for Family History
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 4,           //Family History
                'label' => 'Family Member Diagnosis',
                'doc_control_type_id' => 5,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'lookup_table_used' => 'diagnosis_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'doc_control_group' => 1,       //Group 1
                'doc_control_group_order' => 2, //Group order 2
                'created_by' => 1               //admin
            )
        );
        //Insert records for Family History
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 4,           //Family History
                'label' => 'Family Member Status',
                'doc_control_type_id' => 1 ,    //radio
                'lookup_table_used' => 'lookup_value',
                'doc_control_group' => 1,       //Group 1
                'doc_control_group_order' => 3, //Group order 3
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 4,           //Family History
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        //Insert records for Surgical History
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 5,           //Surgical History
                'label' => 'Surgical History',
                'doc_control_type_id' => 5,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'lookup_table_used' => 'diagnosis_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 5,           //Surgical History
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        //Insert records for Social History
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 6,           //Social History
                'label' => 'Smoke Tobacco',
                'doc_control_type_id' => 1 ,    //radio
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 6,           //Social History
                'label' => 'Non-Smoke Tobacco',
                'doc_control_type_id' => 1,     //radio
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 6,           //Social History
                'label' => 'Drink Alcohol',
                'doc_control_type_id' => 1,     //radio
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 6,           //Social History
                'label' => 'Sexual Activity',
                'doc_control_type_id' => 1,     //radio
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 6,           //Social History
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        //Insert records for Medications
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 7,           //Medications
                'label' => 'Medications',
                'doc_control_type_id' => 5,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'lookup_table_used' => 'med_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 7,           //Medications
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        //Insert records for Vital Signs
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Blood Pressure (BP) Systolic',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Blood Pressure (BP) Diastolic',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Heart Rate (HR)',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Respiratory Rate',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Temperature (Temp) (F)',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
//Removing height and weight from vitals as it is stored in patient table
//      DB::table('doc_control')->insert (
//          array (
//          'navigation_id' => 8,           //Vital Signs
//          'label' => 'Weight (Wt) (Kg)',
//          'doc_control_type_id' => 5,     //Search bar
////            'doc_control_type_id' => 4,     //Dropdown
//          'freetext_value_type_id' => 3,  //character
//          'created_by' => 1               //admin
//          )
//      );
//
//      DB::table('doc_control')->insert (
//          array (
//          'navigation_id' => 8,           //Vital Signs
//          'label' => 'Height (Ht) (Cm)',
//          'doc_control_type_id' => 5,     //Search bar
////            'doc_control_type_id' => 4,     //Dropdown
//          'freetext_value_type_id' => 3,  //character
//          'created_by' => 1               //admin
//          )
//      );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Pain',
                'doc_control_type_id' => 3,     //Freeform text
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 10,          //Constitution
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 10,          //Constitution
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 11,          //HENT
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 11,          //HENT
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 12,          //Eyes
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 12,          //Eyes
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 13,          //Respiratory
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 13,          //Respiratory
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 14,          //Cardiovascular
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 14,          //Cardiovascular
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 15,          //Musculoskeletal
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 15,          //Musculoskeletal
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 16,          //Integumentary
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 16,          //Integumentary
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 17,          //Neurological
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 17,          //Neurological
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 18,          //Psychological
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 18,          //Psychological
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 19,           //ROS-Gastrointestinal
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 19,           //ROS-Gastrointestinal
                'label' => 'Comments',
                'doc_control_type_id' => 3,
                'freetext_value_type_id' => 3,
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 21,          //Constitution
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 21,          //Constitution
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 22,          //HENT
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 22,          //HENT
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 23,          //Eyes
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 23,          //Eyes
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 24,          //Respiratory
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 24,          //Respiratory
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 25,          //Cardiovascular
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 25,          //Cardiovascular
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 26,          //Musculoskeletal
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 26,          //Musculoskeletal
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 27,          //Integumentary
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 27,          //Integumentary
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 28,          //Neurological
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 28,          //Neurological
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 29,          //Psychological
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,     //Checkbox
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 29,          //Psychological
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 30,           //PE-Gastrointestinal
                'label' => 'Symptoms',
                'doc_control_type_id' => 2,
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 30,           //PE-Gastrointestinal
                'label' => 'Comments',
                'doc_control_type_id' => 3,
                'freetext_value_type_id' => 3,
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 33,          //MDM/Plan
                'label' => 'Plan',
                'doc_control_type_id' => 3,     //Checkbox
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 33,          //MDM/Plan
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 34,          //Disposition
                'label' => 'Disposition',
                'doc_control_type_id' => 1,     //Radio
                'lookup_table_used' => 'lookup_value',
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 34,          //Disposition
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Freeform text
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        //Additional Vital Signs documentation controls
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Oxygen Saturation',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Vital_Timestamp',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 32,          //Results
                'label' => 'Order Results',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 32,          //Results
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 31,          //Order
                'label' => 'Lab Orders',
                'doc_control_type_id' => 5,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'lookup_table_used' => 'lab_orders_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 31,          //Order
                'label' => 'Imaging Orders',
                'doc_control_type_id' => 5,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'lookup_table_used' => 'imaging_orders_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        //This is just in case
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 31,          //Order
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //freetext
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Weight (Wt) (Kg)',
                'doc_control_type_id' => 3,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 8,           //Vital Signs
                'label' => 'Height (Ht) (Cm)',
                'doc_control_type_id' => 3,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 31,          //Order
                'label' => 'Procedure Orders',
                'doc_control_type_id' => 5,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'lookup_table_used' => 'procedure_orders_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 34,           //Disposition
                'label' => 'Disposition Diagnosis',
                'doc_control_type_id' => 5,     //Search bar
                'lookup_table_used' => 'diagnosis_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );

        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 7,           //Dosage
                'label' => 'Dosage',
                'doc_control_type_id' => 3,     //freetext
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );

        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 31,          //Order
                'label' => 'Medication Orders',
                'doc_control_type_id' => 5,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'lookup_table_used' => 'med_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );

        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 31,          //Order
                'label' => 'Medication Orders Dosage',
                'doc_control_type_id' => 3,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );

        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 35,          //Order
                'label' => 'DDx Diagnosis',
                'doc_control_type_id' => 5,     //Search bar
                'lookup_table_used' => 'diagnosis_lookup_value',
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );

        DB::table('doc_control')->insert (
            array (
                'navigation_id' => 35,          //Order
                'label' => 'Comments',
                'doc_control_type_id' => 3,     //Search bar
//          'doc_control_type_id' => 4,     //Dropdown
                'freetext_value_type_id' => 3,  //character
                'created_by' => 1               //admin
            )
        );
    }
}
