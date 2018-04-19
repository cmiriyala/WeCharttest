<?php
namespace App\Http\Controllers;
use App\users_patient;
use App\module;
use App\User;
use App\patient;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon;
use App\Notifications\FeedbackNotification;
class InstructorController extends Controller
{
    public function index()
    {
        //Only Instructor can access Instructor Dashboard
        $role = '';
        if (Auth::check()) {
            $role = Auth::user()->role;
        }
        if ($role == 'Instructor') {
            $modules_for_review = array();
            $modules_reviewed = array();
            $for_review_message = '';
            $reviewed_message = '';
            $for_review_patients = users_patient::where( 'user_id', Auth::user()->id )
                ->where( 'patient_record_status_id', 2 )
                ->get();
            $reviewed_patients = users_patient::where( 'user_id', Auth::user()->id )
                ->where( 'patient_record_status_id', 3 )
                ->get();

            if (!empty( $for_review_patients ))
            {
                foreach ($for_review_patients as $for_review_patient) {
                    if ( $for_review_patient->patient->module ) {
                        array_push( $modules_for_review, $for_review_patient->patient->module->module_name );
                    } else {
                        $for_review_message = 'There are no patients for review.';
                    }
                }
            }
            else
            {
                $for_review_message = 'There are no patients for review.';
            }

            if (!empty( $reviewed_patients ))
            {
                foreach ($reviewed_patients as $reviewed_patient) {
                    if ( $reviewed_patient->patient->module ) {
                        array_push( $modules_reviewed, $reviewed_patient->patient->module->module_name );
                    } else {
                        $reviewed_message = 'There are no reviewed patients.';
                    }
                }
            }
            else
            {
                $reviewed_message = 'There are no reviewed patients.';
            }
            $modules_for_review = array_unique( $modules_for_review );
            $modules_reviewed = array_unique( $modules_reviewed );
            return view( 'instructor/instructorHome', compact( 'for_review_patients', 'modules_for_review', 'modules_reviewed', 'for_review_message', 'reviewed_patients', 'reviewed_message' ) );
        }
        else
        {
            $error_message = "You are not authorized to view this page";
            return view( 'auth/not_authorized', compact( $error_message ) );
        }
    }
    // To mark patient's active record as "reviewed"

    //To save the feedback
    public function post_feedback(Request $request)
    {
        $role = '';
        if (Auth::check()) {
            $role = Auth::user()->role;
        }
        if($role == 'Instructor'){

            $feedback_record = users_patient::where('patient_id', $request['patient_id'])->where('user_id',$request['user_id'])->first();

            users_patient::where('users_patient_id', $feedback_record->users_patient_id)->update(['feedback' => $request['feedback']]);

            $user = User::find($feedback_record->created_by);
            $instructor = User::find(Auth::user()->id);
            $insfname = $instructor->firstname;
            $inslname = $instructor->lastname;

            $patient = patient::where('patient_id',$request['patient_id'])->first();
            $patientfname = $patient->first_name;
            $patientlname = $patient->last_name;


            $user->notify(new FeedbackNotification($insfname,$inslname,$patientfname,$patientlname));

            DB::table( 'users_patient' )->where( 'patient_id', $request['patient_id'] )->where( 'user_id', $request['user_id'] )->update( ['patient_record_status_id' => '3', 'updated_by' => $request['user_id'], 'updated_at' => Carbon\Carbon::now( 'CDT' )] );

            return redirect()->route('patient_preview',[$request['patient_id']]);
        }
    }
}