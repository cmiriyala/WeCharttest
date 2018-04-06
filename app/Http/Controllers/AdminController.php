<?php
namespace App\Http\Controllers;
use App\media_lookup_value;
use App\User;
use Illuminate\Http\Request;
use App\EmailidRole;
use App\navigation;
use App\module;
use App\module_navigation;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Only Admin can access Admin Dashboard
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }
        if($role == 'Admin') {
            //Fetching all students and instructors for display on admin landing page
            $students = User::where('role','Student')
                ->where('archived','=','0')
                ->get();
            $instructors = User::where('role','Instructor')
                ->where('archived','=','0')
                ->get();
            return view('admin/home', compact('students','instructors'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function getStudentEmails()
    {
        $counter = 1;
        $Error = '';
        $ErrorPresent='';
        $mailpre='';
        $mailsaved='';
        return view('admin/addStudentEmails', compact('Error','counter','ErrorPresent','mailpre','mailsaved'));
    }
    public function postStudentEmails(Request $request)
    {
        try {
            $counter = count($request['email']);
            $mailsaved= array();
            $mailpre= array();
            $ErrorPresent='';
            $Error='';
            //Removing Duplicates
            $request['email'] = array_unique($request['email']);
            for ($i = 0; $i < $counter ; ++$i)
            {
                $studentEmails = EmailidRole::where('email',$request['email'][$i])->where('role',"Student")->pluck('email');
                $registered_emails = User::where('email',$request['email'][$i])->pluck('email');
                if($studentEmails->count()==1||$registered_emails->count()==1)
                {
                    $ErrorPresent = 'Email Present';
                    array_push($mailpre, ['emailpresent' => $request['email'][$i]]);
                }
                else
                {
                    $EmailIdRole = new EmailidRole;
                    $EmailIdRole['email'] = strtolower($request['email'][$i]);
                    $EmailIdRole['role'] = 'Student';
                    $EmailIdRole->save();
                    $Error = 'No';
                    array_push($mailsaved, ['emailsaved' => $request['email'][$i]]);



                }

            }
            //echo $mailsaved;
            //print_r($mailsaved);
            return view('admin/addStudentEmails',compact('Error','counter','ErrorPresent','mailpre','mailsaved'));
        }
        catch (\Exception $e)
        {
            //Checking if its UNIQUE constraint violation. This is one of the worst code I have ever written
            // in my life
            if(in_array('23505',$e->errorInfo)) {
                $ErrorPresent = 'Instructor Present';
                return view('admin/addStudentEmails',compact('Error','counter','ErrorPresent','mailpre','mailsaved'));
            }
            return view ('errors/503');
        }
    }

    public function getInstructorEmails()
    {
        $counter = 1;
        $Error = '';
        $ErrorPresent='';
        $mailpre='';
        $mailsaved='';
        return view('admin/addInstructorEmails', compact('Error','counter','ErrorPresent','mailpre','mailsaved'));
    }
    public function postInstructorEmails(Request $request)
    {
        try {
            $counter = count($request['email']);
            $mailsaved= array();
            $mailpre= array();
            $ErrorPresent='';
            $Error='';
            //Removing Duplicates
            $request['email'] = array_unique($request['email']);
            for ($i = 0; $i < $counter; $i++)
            {
                $instructorEmails = EmailidRole::where('email',$request['email'][$i])->where('role',"Instructor")->pluck('email');
                $registered_emails = User::where('email',$request['email'][$i])->pluck('email');
                if($instructorEmails->count()==1||$registered_emails->count()==1)
                {
                    $ErrorPresent = 'Email Present';
                    array_push($mailpre, ['emailpresent' => $request['email'][$i]]);
                }
                else {
                    $EmailIdRole = new EmailidRole;
                    $EmailIdRole['email'] = strtolower($request['email'][$i]);
                    $EmailIdRole['role'] = 'Instructor';
                    $EmailIdRole->save();
                    $Error = 'No';
                    array_push($mailsaved, ['emailsaved' => $request['email'][$i]]);
                }
            }

            return view('admin/addInstructorEmails',compact('Error','counter','ErrorPresent','mailpre','mailsaved'));
        }
        catch (\Exception $e)
        {
            //Checking if its UNIQUE constraint violation. This is one of the worst code I have ever written
            // in my life
            if(in_array('23505',$e->errorInfo)) {
                $ErrorPresent = 'Student Present';
                return view('admin/addInstructorEmails',compact('Error','counter','ErrorPresent','mailpre','mailsaved'));
            }
            return view ('errors/503');
        }
    }

    public function getMedia(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }
        if($role == 'Admin') {
            Log::info("here iam");
            Log::info($request['search']);
            $counter = 1;
            session()->put('counter', 1);
            $Error = '';
            $error='';
            $media = media_lookup_value::orderBy('media_lookup_value_tag')
                ->paginate(6);
            $exists=media_lookup_value::where('archived','true')->pluck('media_lookup_value_id');
            $count_exists = $exists->count();
            $exists_tag=media_lookup_value::where('archived','true')->pluck('media_lookup_value_tag');
            $exists_link=media_lookup_value::where('archived','true')->pluck('media_lookup_value_link');
            $changed=media_lookup_value::where('updated_by',1)->pluck('media_lookup_value_id');
            $count_added = $changed->count();
            $added_tag=media_lookup_value::where('updated_by',1)->pluck('media_lookup_value_tag');
            $added_link=media_lookup_value::where('updated_by',1)->pluck('media_lookup_value_link');
            if(($exists->count())>0)
            {
                $Error='Exists';
                for($i=0; $i<($exists->count()); $i++)
                {
                    media_lookup_value::where('media_lookup_value_id',$exists[$i])->update(['archived' => 'false']);
                }
            }
            if(($changed->count()))
            {
                $error='Does not Exist';
                for($i=0; $i<($changed->count()); $i++)
                {
                    media_lookup_value::where('media_lookup_value_id',$changed[$i])->update(['updated_by' => null]);
                }
            }
            return view('admin/addMedia',compact('error','counter','count_exists','Error','exists_tag','count_added','added_tag','media','exists_link','added_link'));
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function postMedia(Request $request)
    {
        $counter = count($request['link']);
        for ($i = 0; $i < $counter; $i++) {
            Log::info($request['tag'][$i]);
            Log::info($request['link'][$i]);
            Log::info($_POST['type'][$i]);
            $exist_tag = media_lookup_value::where('media_lookup_value_tag', $request['tag'][$i])->where('media_lookup_value_type', $_POST['type'][$i])->pluck('media_lookup_value_tag');
            $exist_link = media_lookup_value::where('media_lookup_value_link', $request['link'][$i])->where('media_lookup_value_type', $_POST['type'][$i])->pluck('media_lookup_value_link');
            if (($exist_tag->count()) > 0) {
                DB::table('media_lookup_value')->where('media_lookup_value_tag', $request['tag'][$i])->update(['archived' => 'true']);
            } elseif (($exist_link->count()) > 0) {
                DB::table('media_lookup_value')->where('media_lookup_value_link', $request['link'][$i])->update(['archived' => 'true']);
            } else {
                if($request['tag'][$i]!=null && $request['link'][$i]!=null) {
                    $media_lookup_value = new media_lookup_value;
                    $media_lookup_value['media_lookup_value_tag'] = $request['tag'][$i];
                    $media_lookup_value['media_lookup_value_type'] = $_POST['type'][$i];
                    $media_lookup_value['media_lookup_value_link'] = $request['link'][$i];
                    $media_lookup_value['archived'] = false;
                    $media_lookup_value['created_by'] = 1;
                    $media_lookup_value['updated_by'] = 1;
                    $media_lookup_value->save();
                }
            }
        }
        return redirect()->route('AddMedia');
    }
    public function addMedia(Request $request)
    {
        $counter = session()->get('counter');
        $counter = $counter + 1;
        session()->put('counter', $counter);
        $error = '';
        $Error = '';
        $search = $request['search'];
        $media = media_lookup_value::where('media_lookup_value_tag', 'ilike', '%'.$search.'%')
            ->orderBy('media_lookup_value_tag')
            ->paginate(6);
        return view('admin/addMedia',compact('error','counter','Error','media'));
    }
    public function removeMedia(Request $request)
    {
        $counter = session()->get('counter');
        $counter = $counter - 1;
        session()->put('counter', $counter);
        $error = '';
        $Error = '';
        $search = $request['search'];
        $media = media_lookup_value::where('media_lookup_value_tag', 'ilike', '%'.$search.'%')
            ->orderBy('media_lookup_value_tag')
            ->paginate(6);
        return view('admin/addMedia',compact('error','counter','Error','media'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function searchMedia(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $rownum=0;
            $media=media_lookup_value::where('media_lookup_value_tag','ilike','%'.$request->search.'%')->orderby('media_lookup_value_tag')->paginate(6);
            if($media)
            {
                foreach ($media as $key => $media) {
                    $rownum = $rownum + 1;
                    $output.='<tr>'.
                        '<td>'.$media->media_lookup_value_tag.'</td>'.
                        '<td>'.'<select id="optionselect" class="optionselect" required><option></option>
                                        <option value="Audio">Audio</option>
                                        <option value="Video">Video</option>
                                        <option value="Image">Image</option>
                                    </select>'.'<p class="display">'.$media->media_lookup_value_type.'</p>'.'</td>'.
                        '<td>'.$media->media_lookup_value_link.'</td>'.
                        '<td>'.'<a href = '.$media->media_lookup_value_link.' target="_blank"  class="btn btn-default" id="audlink'.$rownum.'">'.'<i class="fa fa-link" aria-hidden="true" style="color:#A569BD"></i>'.'</a>'.'</td>'.
                        '<td>'.
                                    '<button class="editButton btn btn-info" id='.$rownum.'><i class="fa fa-edit" aria-hidden="true"></i></button>'.
                                    '<button class="saveButton btn btn-success" id='.$rownum. ' value='.$media->media_lookup_value_id.'><i class="fa fa-save" aria-hidden="true"></i></button>'.
                                '</td>'.
                        '<td>'.'<a href="'.route('delete_media',[ $media->media_lookup_value_id]).'" class="btn btn-danger enable" id="delete" onclick="return Delete()"> <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </a>'.'</td>'.

                        '</tr>';

                }
                return Response($output);
            }
        }
    }
    public function post_new_media(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }
        if($role == 'Admin') {
            $mediaid = $request['id'];
            $mediatag = $request['name'];
            $mediatype = $request['type'];
            $mediavalue = $request['link'];
            media_lookup_value::where('media_lookup_value_id', $mediaid)->update(['media_lookup_value_tag' => $mediatag]);
            media_lookup_value::where('media_lookup_value_id', $mediaid)->update(['media_lookup_value_type' => $mediatype]);
            media_lookup_value::where('media_lookup_value_id', $mediaid)->update(['media_lookup_value_link' => $mediavalue]);
            //Now redirecting to orders page
            return redirect()->back();
        }
        else
        {
            return view('auth/not_authorized');
        }
    }
    public function get_remove_emails()
    {
        $studentEmails = EmailidRole::where('role','Student')->pluck('email');
        $studentEmails = str_replace(['['], '', $studentEmails);
        $studentEmails = str_replace(['"'], '', $studentEmails);
        $studentEmails = str_replace(['"'], '', $studentEmails);
        $studentEmails = str_replace([']'], '', $studentEmails);
        $studentEmails = explode(",", $studentEmails);
        $registered_student_emails = User::where('role','Student')->pluck('email');
        $registered_student_emails = str_replace(['['], '', $registered_student_emails);
        $registered_student_emails = str_replace(['"'], '', $registered_student_emails);
        $registered_student_emails = str_replace(['"'], '', $registered_student_emails);
        $registered_student_emails = str_replace([']'], '', $registered_student_emails);
        $registered_student_emails = explode(",", $registered_student_emails);
        $studentEmails = array_diff($studentEmails,$registered_student_emails);
        $studentDetails = array();
        foreach($studentEmails as $studentEmail)
        {
            $studentDetail = EmailidRole::where('email',$studentEmail)->get();
            array_push($studentDetails,$studentDetail);
        }
        $instructorEmails = EmailidRole::where('role','Instructor')->pluck('email');
        $instructorEmails = str_replace(['['], '', $instructorEmails);
        $instructorEmails = str_replace(['"'], '', $instructorEmails);
        $instructorEmails = str_replace(['"'], '', $instructorEmails);
        $instructorEmails = str_replace([']'], '', $instructorEmails);
        $instructorEmails = explode(",", $instructorEmails);
        $registered_instructor_emails = User::where('role','Instructor')->pluck('email');
        $registered_instructor_emails = str_replace(['['], '', $registered_instructor_emails);
        $registered_instructor_emails = str_replace(['"'], '', $registered_instructor_emails);
        $registered_instructor_emails = str_replace(['"'], '', $registered_instructor_emails);
        $registered_instructor_emails = str_replace([']'], '', $registered_instructor_emails);
        $registered_instructor_emails = explode(",", $registered_instructor_emails);
        $instructorEmails = array_diff($instructorEmails,$registered_instructor_emails);
        $instructorDetails = array();
        foreach($instructorEmails as $instructorEmail)
        {
            $instructorDetail = EmailidRole::where('email',$instructorEmail)->get();
            array_push($instructorDetails,$instructorDetail);
        }
        return view('admin/remove_emails', compact('studentDetails','instructorDetails'));
    }
    public function getConfigureModules()
    {
        $navs = navigation::where('navigation_id','<>','35')->get();
        $mods = module::where('archived', false)->get();
        $navs_mods = module_navigation::where('visible', true)->where('navigation_id','<>','35')->get();
        return view('admin/configureModules', compact ('navs', 'mods', 'navs_mods'));
    }


    public function submitmodule(Request $request)
    {
        $role='';
        if(Auth::check()) {
            $role = Auth::user()->role;
        }
        if($role == 'Admin'||'Instructor') {
            $messages = ['required' => 'Module name is mandatory.'];
            //Validating input data
            $this->validate($request, [
                'modulename' => 'required',
            ], $messages);
            $module = new module;
            $module->module_name = $request->input('modulename');
            $module->archived = false;
            $module->save();
            $var = $module->module_id;
            $navs = $request->input('navs');
            //if any child selected, parent shoul get auto selected.
            for ($i = 3; $i < 7; $i++) {
                if (in_array("$i", $navs)) {
                    array_push($navs, '2');
                    break;
                }
            }
            for ($i = 10; $i < 20; $i++) {
                if (in_array("$i", $navs)) {
                    array_push($navs, '9');
                    break;
                }
            }
            for ($i = 21; $i < 31; $i++) {
                if (in_array("$i", $navs)) {
                    array_push($navs, '20');
                    break;
                }
            }
            $navs = array_unique($navs);
            foreach ($navs as $navid) {
                DB::table('modules_navigations')->insert(
                    ['module_id' => $var, 'navigation_id' => $navid,
                        'display_order' => $navid, 'visible' => true ]);
            }
            module_navigation::where('visible', true)->where('navigation_id','19')->where('module_id',$var)->update(['display_order' => '15']);
            module_navigation::where('visible', true)->where('navigation_id','15')->where('module_id',$var)->update(['display_order' => '16']);
            module_navigation::where('visible', true)->where('navigation_id','16')->where('module_id',$var)->update(['display_order' => '17']);
            module_navigation::where('visible', true)->where('navigation_id','17')->where('module_id',$var)->update(['display_order' => '18']);
            module_navigation::where('visible', true)->where('navigation_id','18')->where('module_id',$var)->update(['display_order' => '19']);
            module_navigation::where('visible', true)->where('navigation_id','30')->where('module_id',$var)->update(['display_order' => '26']);
            module_navigation::where('visible', true)->where('navigation_id','26')->where('module_id',$var)->update(['display_order' => '27']);
            module_navigation::where('visible', true)->where('navigation_id','27')->where('module_id',$var)->update(['display_order' => '28']);
            module_navigation::where('visible', true)->where('navigation_id','28')->where('module_id',$var)->update(['display_order' => '29']);
            module_navigation::where('visible', true)->where('navigation_id','29')->where('module_id',$var)->update(['display_order' => '30']);


            $navs = navigation::where('navigation_id','<>','35')->get();
            $mods = module::where('archived', false)->get();
            $navs_mods = module_navigation::where('visible', true)->where('navigation_id','<>','35')->get();
            return view('admin/configureModules', compact('navs', 'mods', 'navs_mods'));
        }
        else
        {
            $error_message= "You are not authorized to view this page.";
            return view('errors/error',compact('error_message'));
        }
    }
    public function deletemodule($modid)
    {
        module::where('module_id',$modid)->update(['archived' => true]);
        $navs = navigation::where('navigation_id','<>','35')->get();
        $mods = module::where('archived', false)->get();
        $navs_mods = module_navigation::where('visible', true)->where('navigation_id','<>','35')->get();
        return view('admin/configureModules', compact ('navs', 'mods', 'navs_mods'));
    }
    public function delete_email($id)
    {
        $email = EmailidRole::find($id);
        $email->delete();
        return redirect('RemoveEmails')->with('success','Email has been deleted');
    }
    public function archive_user($id)
    {
        User::where('id',$id)
            ->update(['archived'=> 1]);
        $email = User::where('id',$id)->pluck('email');
        return redirect('/home')->with('success','Email has been  deleted');
    }
    public function delete_media($id)
    {
        $media = media_lookup_value::find($id);
        $media->delete();
        return redirect()->back();
    }




}