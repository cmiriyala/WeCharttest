<?php

namespace App\Http\Controllers;
use App\diagnosis_lookup_value;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\audio_lookup_value;
use App\video_lookup_value;
use App\image_lookup_value;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon;
// use Illuminate\Http\Request;
use Auth;
use App\User;
use App\users_patient;
use App\patient;
use App\active_record;
use View;

class GuidanceController extends Controller
{
    public function get_video_list()
    {
        $categories = video_lookup_value::all()->toArray();
        return view('patient/orders',compact('categories'));

    }

public function post_ddx(Request $request)
    {


            //Validating input data
            $this->validate($request, [
            ]);

            try {
                $diagnosis = $request['search_diagnosis_ddx'];

                //Saving medications
                foreach ((array)$diagnosis as $key => $item) {
                    $lab_value = diagnosis_lookup_value::where('diagnosis_lookup_value_id', $item)->pluck('diagnosis_lookup_value');
                    $active_record = new active_record();
                    $active_record['patient_id'] = $request['patient_id'];
                    $active_record['navigation_id'] = '35';
                    $active_record['doc_control_id'] = '83';
                    $active_record['value'] = $lab_value[0];
                    $active_record['created_by'] = $request['user_id'];
                    $active_record['updated_by'] = $request['user_id'];
                    $active_record->save();
                }
                sleep(1);
                $output = "";
                $diagnosis_list_ddx = active_record::leftjoin('active_record as act2', 'active_record.active_record_id', '=', 'act2.doc_control_group')
                    ->where('active_record.patient_id', '=', $request['patient_id'])
                    ->where('active_record.navigation_id', '=', '35')
                    ->where('active_record.doc_control_id', '=', '83')
                    ->whereNull('active_record.doc_control_group')
                    ->select('active_record.*', 'act2.value as comments')->orderBy('active_record.doc_control_group_order', 'ASC')
                    ->orderBy('active_record.active_record_id', 'ASC')->get();
                Log::info("diagnosis");
                Log::info($diagnosis_list_ddx);
                if ($diagnosis_list_ddx) {

                    foreach ($diagnosis_list_ddx as $key =>$diagnosis) {
                        $output.= '<tr id=' . $diagnosis->active_record_id . '>'.
                            '<td><p>' . $diagnosis->value . '</p></td>' .
                            '<td><textarea type="text" id="Textcom" name="Textcom[]" data-diagnosisid='.$diagnosis->active_record_id.'>'.$diagnosis->comments.'</textarea></td>'.
                            '</tr>';
                    }
                        return Response($output);

                }
            }
            catch (Exception $e) {
                return view('errors/503');
            }

    }
public function post_ddx_sorted(Request $request)
    {
        Log::info("here");

            //Validating input data
            $this->validate($request, [
            ]);

            try {
                $i=0;
                foreach ($request->input('parameters') as $parameter) {
                    $i = $i+1;
                    active_record::where('active_record_id', $parameter)->update(['doc_control_group_order' => $i]);
                }
                return redirect()->back();
                //return redirect()->route('Demographics',[$request['patient_id']]);
            }
            catch (Exception $e) {
                return view('errors/503');
            }

    }
}