<?php

use Illuminate\Database\Seeder;

class usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            array(
                'email' => 'admin@wechart.com',
                'password' => Hash::make('wechartadmin'),
                'firstname' => 'Thanh',
                'lastname' => 'Nguyen',
                'role' => 'Admin'
            )
        );
    }
}
