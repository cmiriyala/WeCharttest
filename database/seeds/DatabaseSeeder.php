<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
			med_lookup_valueTableSeeder::class,
			diagnosis_lookup_valueTableSeeder::class,
			imaging_orders_lookup_valueTableSeeder::class,
			lab_orders_lookup_valueTableSeeder::class,
            media_lookup_valueTableSeeder::class,
            procedure_orders_lookup_valueTableSeeder::class,
            departmentTableSeeder::class,
			emailidroleTableSeeder::class,
            usersTableSeeder::class,
            patient_record_statusTableSeeder::class,
            navigationsTableSeeder::class,
            lookup_valueTableSeeder::class,
            doc_control_typeTableSeeder::class,
            freetext_value_typeTableSeeder::class,
            doc_controlTableSeeder::class,
            doc_lookup_valueTableSeeder::class,
            security_questionTableSeeder::class,
            security_question_usersTableSeeder::class


		]);
    }
}
