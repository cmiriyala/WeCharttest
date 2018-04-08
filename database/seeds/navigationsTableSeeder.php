<?php

use Illuminate\Database\Seeder;

class navigationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('navigations')->insert([
            [
                'navigation_id' => '1',
                'navigation_name' => 'History of Present Illness (HPI)',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '2',
                'navigation_name' => 'Medical History',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '3',
                'navigation_name' => 'Personal History (PMHx)',
                'parent_id' =>  2
            ],
            [
                'navigation_id' => '4',
                'navigation_name' => 'Family History (FMHx)',
                'parent_id' =>  2
            ],
            [
                'navigation_id' => '5',
                'navigation_name' => 'Surgical History',
                'parent_id' =>  2
            ],
            [
                'navigation_id' => '6',
                'navigation_name' => 'Social History (SHx)',
                'parent_id' =>  2
            ],
            [
                'navigation_id' => '7',
                'navigation_name' => 'Medications',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '8',
                'navigation_name' => 'Vital Signs',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '9',
                'navigation_name' => 'Review of System (ROS)',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '10',
                'navigation_name' => 'Constitutional',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '11',
                'navigation_name' => 'HENT',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '12',
                'navigation_name' => 'Eyes',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '13',
                'navigation_name' => 'Respiratory',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '14',
                'navigation_name' => 'Cardiovascular',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '19',   
                'navigation_name' => 'Gastrointestinal',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '15',
                'navigation_name' => 'Musculoskeletal',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '16',
                'navigation_name' => 'Integumentary',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '17',
                'navigation_name' => 'Neurological',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '18',
                'navigation_name' => 'Psychological',
                'parent_id' =>  9
            ],
            [
                'navigation_id' => '20',
                'navigation_name' => 'Physical Exam',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '21',
                'navigation_name' => 'Constitutional',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '22',
                'navigation_name' => 'HENT',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '23',
                'navigation_name' => 'Eyes',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '24',
                'navigation_name' => 'Respiratory',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '25',
                'navigation_name' => 'Cardiovascular',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '30',
                'navigation_name' => 'Gastrointestinal',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '26',
                'navigation_name' => 'Musculoskeletal',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '27',
                'navigation_name' => 'Integumentary',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '28',
                'navigation_name' => 'Neurological',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '29',
                'navigation_name' => 'Psychological',
                'parent_id' =>  20
            ],
            [
                'navigation_id' => '31',
                'navigation_name' => 'Orders',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '32',
                'navigation_name' => 'Results',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '33',
                'navigation_name' => 'MDM/Plan',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '34',
                'navigation_name' => 'Disposition',
                'parent_id' =>  null
            ],
            [
                'navigation_id' => '35',
                'navigation_name' => 'DDx',
                'parent_id' =>  null   
            ]
        ]);
    }
}
