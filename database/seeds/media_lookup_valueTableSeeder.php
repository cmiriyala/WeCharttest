<?php

use Illuminate\Database\Seeder;

use App\Csvdata;

class media_lookup_valueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array1= array();
        $array2= array();
        $array3= array();
        //clear out staging table
        DB::table('csv_data')->truncate();
        DB::table('media_lookup_value')->truncate();


        //Load tab-delimited file for medications
        if (($handle = fopen ( public_path('media_list.txt'), 'r' )) !== FALSE) {
            while ($data = fgetcsv ($handle, 1000, "\t")) {

                $csv_data = new Csvdata ();
                $csv_data->medical_list = $data[0];
                array_push($array1,$data[0]);
                array_push($array2,$data[1]);
                array_push($array3,$data[2]);                
                $csv_data->save();

            }
            fclose ($handle);
        };

        for($i=0;$i<count($array1);$i++){
            DB::table('media_lookup_value')->insert(
                [
                    'media_lookup_value_tag' =>  $array1[$i],
                    'media_lookup_value_link' => $array2[$i],                    
                    'media_lookup_value_type' => $array3[$i], 

                    'created_by'=>1
                ]);
        }
        //
        //
    }
}
