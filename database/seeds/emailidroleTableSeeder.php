<?php

use Illuminate\Database\Seeder;

class emailidroleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return voidude
     */
    public function run()
    {
        //
        DB::table('EmailIdRole')->insert(
            array(
                'email' => 'admin@wechart.com',
                'role' => 'Admin'
            )
        );
    }
}
