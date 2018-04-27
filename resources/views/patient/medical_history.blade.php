@extends('patient.active_record')

@section('documentation_panel')
    <style type="text/css">
        .blockDiv {
            position: absolute;
            top: 0px;
            left: 0px;
            background-color: #FFF;
            width: 0px;
            height: 0px;
            z-index: 10;
        }
        #loading-image{
            position: fixed;
            left:38.3%;
            top:50%;
            center: 100%;
            width: 10em;
            margin-top: -2.5em;
        }
        #loading-Done{
            position: fixed;
            left:38.3%;
            top:50%;
            center: 100%;
            width: 10em;
            margin-top: -2.5em;
        }
        #btn_save_all{
            position: absolute;
            left:13.5vw;
            top:2vh;
            center: 100vw;
            width: 15em;
            margin-top: -2.5em;
            height: 4.5vh;
            line-height: 2vh;
            padding-top:1vh;
            margin-right: 20vw;
        }
    </style>

    <script type="text/javascript" language="javascript">

        function block_screen() {
            $('<div id="screenBlock"></div>').appendTo('body');
            $('#screenBlock').css( { opacity: 0, width: $(document).width(), height: $(document).height() } );
            $('#screenBlock').addClass('blockDiv');
            $('#screenBlock').animate({opacity: 0.7}, 200);
        }

        function unblock_screen() {
            $('#screenBlock').animate({opacity: 0}, 200, function() {
                $('#screenBlock').remove();
            });
        }

    </script>
    <br>
    <br>

    @if(in_array("3", $navIds))
        {{--Personal History--}}
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">Personal History</h4>
                </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('personal_history') }}" id="personal_history_form">
                            {{ csrf_field() }}
                            <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                            <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                            <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="container-fluid">
                            {{--Panel--}}
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr class="bg-warning">
                                            <th>List of Diagnosis</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($diagnosis_list_personal_history as $diagnosis)
                                            <tr>
                                                <td><p><?php echo ($diagnosis->value); ?></p></td>
                                                <td>
                                                    <a href="{{ route( 'delete_personal_history', ['active_record_id' => $diagnosis->active_record_id]) }}"
                                                       class="btn btn-danger enable" id="delete" onclick="return Delete()">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <!-- Search For Diagnosis -->
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="Diagnosis"> Diagnosis:</label>
                                </div>
                                <div class="col-md-6 ">
                                    <select id="search_diagnosis_personal_history" class="js-example-basic-multiple js-states form-control " name="search_diagnosis_personal_history[]" multiple></select>
                                </div>
                            </div>
                            <br>
                            <!-- Comment box -->
                            <div class="row">
                                    <div class="col-md-12">
                                        <label for="Comment"> Comments:</label>
                                        <br>
                                        @if(!count($personal_history_comment)>0)
                                            <textarea rows="4" id="personal_history_comment" name="personal_history_comment" style="width: 100%;display: block"></textarea>
                                        @else
                                            <textarea rows="4" id="personal_history_comment" name="personal_history_comment" style="width: 100%;display: block">{{$personal_history_comment[0]->value}}</textarea>
                                        @endif
                                    </div>
                                </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_reset_personal_history" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Personal History
                                    </button>
                                  </div>
                                <div class="col-md-6">
                                    <button type="submit" id="btn_save_personal_history" class="btn btn-primary" style="float: right">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Personal History
                                    </button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>

            </div>
        </div>
       @endif

    @if(in_array("4", $navIds))
        {{--Family History--}}
        <div class="container-fluid" id="family_history">
        <div class="panel panel-default">
            <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                <h4 style="margin-top: 0;color:#000; font-weight:500">Family History</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('family_history') }}" id="family_history_form">
                    {{ csrf_field() }}
                    <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                    <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                    <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="container-fluid">
                    <div class="row">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-warning">
                                <th>Relation</th>
                                <th>Alive?</th>
                                <th>List of Diagnosis</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($family_members_details as $family_member_details)
                                    <tr>
                                        <td><p><?php echo ($family_member_details->relation); ?></p></td>
                                        <td>
                                            @if(count($family_member_details->status)>0)
                                                <p><?php echo ($family_member_details->status[0]); ?></p>
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($family_member_details->diagnosis as $family_member_diagnosis)

                                                            <p><?php echo ($family_member_diagnosis); ?></p>

                                            @endforeach
                                        </td>
                                        <td>
                                            <!-- <a id="_delete" class="btn btn-danger btn-sm" style="float:right">
                                                Delete </a> -->
                                            <a href="{{ route( 'delete_family_history', ['active_record_id' => $family_member_details->id]) }}"
                                               class="btn btn-danger enable" id="delete" onclick="return Delete()">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row" >
                        <a id="add_family_member" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        Add Family Member
                        </a>
                    </div>
                    <div class="row" id="new_family_member_panel" style="border: solid">
                        <div class="col-md-12">
                            <div class="container-fluid" >
                        <br>
                        <div class="row" >
                            <div class="col-md-12">
                                <label id="familyMember" for="SearchForDiagnosis">Relation:</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <input id="relation_family_history" style="width: 200px" type="text" name="relation_family_history">
                                <br>
                                <br>
                                <label id="family_member_status_label">Alive?:</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" class="form-check-input inline family_member_status" name="family_member_status" value="Yes" id="family_member_status_yes" checked="checked">&nbsp;Yes
                                <input type="radio" class="form-check-input inline family_member_status" name="family_member_status" value="No" id="family_member_status_no">&nbsp;No
                                <br>
                                <br>
                                <label>Diagnosis:</label>&nbsp;&nbsp;
                                <select id="search_diagnosis_list_family_history" style="width: 500px" class="js-example-basic-multiple js-states " name="search_diagnosis_list_family_history[]" multiple></select>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                            <button type="submit" id="btn_save_new_family_member" class="btn btn-primary" >
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save
                            </button> &nbsp;&nbsp;&nbsp;
                            <button type="reset" id="btn_cancel_new_family_member" class="btn btn-success" >
                                <i class="fa fa-ban" aria-hidden="true"></i> Cancel
                            </button>
                            </div>
                        </div>
                        <br>
                    </div>
                        </div>
                    </div>
                    <br>
                    <!-- Comment box -->
                    <div class="row">
                        <label for="Comment"> Comments:</label>
                        <br>
                        @if(!count($comment_family_history) > 0)
                        <textarea rows="4" id="family_history_comment" name="family_history_comment" style="width: 100%;display: block" ></textarea>
                        @else
                            <textarea rows="4" id="family_history_comment" name="family_history_comment" style="width: 100%;display: block" >{{$comment_family_history[0]}}</textarea>
                        @endif
                     </div>
                    <br>
                    {{--Save button--}}
                    <div class="row">
                         <button type="reset" id="btn_reset_family_history" class="btn btn-success" style="float: left">
                            <i class="fa fa-refresh" aria-hidden="true"></i> Reset Comment
                        </button>
                        <button type="submit" id="btn_save_family_history" class="btn btn-primary"  style="float: right">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Comment
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    @if(in_array("5", $navIds))
        {{--Surgical History--}}
        <div class="container-fluid" id="surgical_history">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">Surgical History</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('surgical_history') }}" id="surgical_history_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            {{--Panel--}}
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr class="bg-warning">
                                            <th>List of Diagnosis</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($diagnosis_list_surgical_history as $diagnosis)
                                            <tr>
                                                <td><p><?php echo ($diagnosis->value); ?></p></td>
                                                <td>
                                                    <a href="{{ route( 'delete_surgical_history', ['active_record_id' => $diagnosis->active_record_id]) }}"
                                                       class="btn btn-danger enable" id="delete" onclick="return Delete()">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <!-- Search For Diagnosis -->
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="Diagnosis"> Diagnosis:</label>
                                </div>
                                <div class="col-md-6 ">
                                    <select id="search_diagnosis_surgical_history" class="js-example-basic-multiple js-states form-control " name="search_diagnosis_surgical_history[]" multiple></select>
                                </div>
                            </div>
                            <br>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($surgical_history_comment)>0)
                                        <textarea rows="4" id="surgical_history_comment" name="surgical_history_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="surgical_history_comment" name="surgical_history_comment" style="width: 100%;display: block">{{$surgical_history_comment[0]->value}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_reset_surgical_history" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Surgical History
                                    </button>
                                </div>
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_surgical_history" class="btn btn-primary" style="float: right">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Surgical History
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endif

    @if(in_array("6", $navIds))
        {{--Social History--}}
        <div class="container-fluid" id="social_history">
        <div class="panel panel-default">
            <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                <h4 style="margin-top: 0;color:#000; font-weight:500">Social History</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" id="social_history_form" action="{{ route('social_history') }}">
                 {{ csrf_field() }}
                    <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                    <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                    <input type=hidden name="is_new_entry_social_history" value="{{ $is_new_entry_social_history }}">
                    <input type=hidden name="social_history_smoke_tobacco_id" value="{{ $social_history_smoke_tobacco_id }}">
                    <input type=hidden name="social_history_non_smoke_tobacco_id" value="{{ $social_history_non_smoke_tobacco_id }}">
                    <input type=hidden name="social_history_alcohol_id" value="{{ $social_history_alcohol_id }}">
                    <input type=hidden name="social_history_sexual_activity_id" value="{{ $social_history_sexual_activity_id }}">
                    <input type=hidden name="social_history_comment_id" value="{{ $social_history_comment_id }}">
                    <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                <div class="container-fluid">
                    <br>
                    {{--Smoke Tobaco--}}
                    <div class="row">
                        <div class="col-md-4">
                            <label id="smoke_tobacco">Smoke Tobacco?: </label>
                        </div>
                        <div class="col-md-6">
                            @if($social_history_smoke_tobacco == "YES")
                                <input type="radio" class="form-check-input inline" name="smoke_tobacco" value="YES" id="smoke_tobacco_yes" checked > Yes
                                <input type="radio" class="form-check-input inline" name="smoke_tobacco" value="NO" id="smoke_tobacco_no"> No
                            @elseif($social_history_smoke_tobacco == "NO")
                                <input type="radio" class="form-check-input inline" name="smoke_tobacco" value="YES" id="smoke_tobacco_yes" > Yes
                                <input type="radio" class="form-check-input inline" name="smoke_tobacco" value="NO" id="smoke_tobacco_no" checked> No
                            @else
                                <input type="radio" class="form-check-input inline" name="smoke_tobacco" value="YES" id="smoke_tobacco_yes" > Yes
                                <input type="radio" class="form-check-input inline" name="smoke_tobacco" value="NO" id="smoke_tobacco_no" > No
                            @endif
                        </div>
                    </div>
                    <br>
                    {{--Non Smoke Tobaco--}}
                    <div class="row">
                        <div class="col-md-4">
                            <label id="non_smoke_tobacco">Non-Smoke Tobacco?: </label>
                        </div>
                        <div class="col-md-6">
                            @if($social_history_non_smoke_tobacco == "YES")
                                <input type="radio" class="form-check-input inline" name="non_smoke_tobacco" value="YES" id="non_smoke_tobacco_yes" checked > Yes
                                <input type="radio" class="form-check-input inline" name="non_smoke_tobacco" value="NO" id="non_smoke_tobacco_no"> No
                            @elseif ($social_history_non_smoke_tobacco == "NO")
                                <input type="radio" class="form-check-input inline" name="non_smoke_tobacco" value="YES" id="non_smoke_tobacco_yes" > Yes
                                <input type="radio" class="form-check-input inline" name="non_smoke_tobacco" value="NO" id="non_smoke_tobacco_no" checked> No
                            @else
                                <input type="radio" class="form-check-input inline" name="non_smoke_tobacco" value="YES" id="non_smoke_tobacco_yes" > Yes
                                <input type="radio" class="form-check-input inline" name="non_smoke_tobacco" value="NO" id="non_smoke_tobacco_no"> No
                            @endif
                        </div>
                    </div>
                    <br>
                    {{--Alcohol--}}
                    <div class="row">
                        <div class="col-md-4">
                            <label id="alcohol">Drink Alcohol?: </label>
                        </div>
                        <div class="col-md-6">
                            @if($social_history_alcohol == "YES")
                                <input type="radio" class="form-check-input inline" name="alcohol" checked value="YES" id="alcohol_yes" > Yes
                                <input type="radio" class="form-check-input inline" name="alcohol" value="NO" id="alcohol_no"> No
                            @elseif($social_history_alcohol == "NO")
                                <input type="radio" class="form-check-input inline" name="alcohol" value="YES" id="alcohol_yes" > Yes
                                <input type="radio" class="form-check-input inline" name="alcohol" checked value="NO" id="alcohol_no"> No
                            @else
                                <input type="radio" class="form-check-input inline" name="alcohol" value="YES" id="alcohol_yes" > Yes
                                <input type="radio" class="form-check-input inline" name="alcohol" value="NO" id="alcohol_no"> No
                            @endif
                        </div>
                    </div>
                    <br>
                    {{--Sexual Avtivity--}}
                    <div class="row">
                        <div class="col-md-4">
                            <label id="sexual_activity">Sexual Activity?: </label>
                        </div>
                        <div class="col-md-6">
                            @if($social_history_sexual_activity == "YES")
                                <input type="radio" class="form-check-input inline" name="sexual_activity" checked value="YES" id="sexual_activity_active"> Active
                                <input type="radio" class="form-check-input inline" name="sexual_activity" value="NO" id="sexual_activity_not_active"> Not Active
                            @elseif($social_history_sexual_activity == "NO")
                                <input type="radio" class="form-check-input inline" name="sexual_activity" value="YES" id="sexual_activity_active"> Active
                                <input type="radio" class="form-check-input inline" name="sexual_activity" checked value="NO" id="sexual_activity_not_active"> Not Active
                            @else
                                <input type="radio" class="form-check-input inline" name="sexual_activity" value="YES" id="sexual_activity_active"> Active
                                <input type="radio" class="form-check-input inline" name="sexual_activity" value="NO" id="sexual_activity_not_active"> Not Active
                            @endif
                        </div>
                    </div>
                    <br>
                    {{--Comment--}}
                    <div class="row">
                        <div class="col-md-12">
                            <label id="social_history_comment_label">Comments: </label>
                            <br>
                            <textarea rows="4" style="width: 100%;display: block" id="social_history_comment" name="social_history_comment" >{{$social_history_comment}}</textarea>
                        </div>
                    </div>
                    <br>
                    {{--Buttons--}}
                    <div class="row">
                        <div class="col-md-6">
                            <button type="reset" id="btn_reset_social_history" class="btn btn-success" style="float: left">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Reset Social History
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" id="btn_save_social_history" class="btn btn-primary" style="float: right">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Social History
                            </button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
            <div id="loading-image" style="display: none;"><img src="{{URL::asset('logos/load.gif')}}"> <br> <center><h3> Saving Data..</h3></center></div>
            <div id="loading-Done" style="display: none;"><img src="{{URL::asset('logos/saved.png')}}"> <br> <center><h3> Saved </h3></center></div>
        </div>
    </div>
    @endif

    <div id="loading-image" style="display: none;"><img src="{{URL::asset('logos/load.gif')}}"> <br> <center><h3> Saving Data..</h3></center></div>
    <div id="loading-Done" style="display: none;"><img src="{{URL::asset('logos/saved.png')}}"> <br> <center><h3> Saved </h3></center></div>
    <button type="submit" id="btn_save_all" class="btn btn-primary btn-lg btn-block">
        <center><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Medical History</center>
    </button>



    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
         $('#search_diagnosis_personal_history').select2({
             placeholder: "Choose Diagnosis...",
             minimumInputLength: 2,
             ajax: {
                 url: '{{route('diagnosis_find')}}',
                 dataType: 'json',
                 data: function (params) {
                     return {
                         q: $.trim(params.term),
                     };
                 },
                 processResults: function (data) {
                     return {
                         results: data
                     };
                 },
                 cache: false
             }
         });

         $('#search_diagnosis_surgical_history').select2({
             placeholder: "Choose Diagnosis...",
             minimumInputLength: 2,
             ajax: {
                 url: '{{route('diagnosis_find')}}',
                 dataType: 'json',
                 data: function (params) {
                     return {
                         q: $.trim(params.term)
                     };
                 },
                 processResults: function (data) {
                     return {
                         results: data
                     };
                 },
                 cache: false
             }
         });

         $('#search_diagnosis_list_family_history').select2({
             placeholder: "Choose Diagnosis...",
             minimumInputLength: 2,
             ajax: {
                 url: '{{route('diagnosis_find')}}',
                 dataType: 'json',
                 data: function (params) {
                     return {
                         q: $.trim(params.term),
                     };
                 },
                 processResults: function (data) {
                     return {
                         results: data
                     };
                 },
                 cache: false
             }
         });

         $(document).ready(function()
         {
             $('#loading-image').hide();
             $('#loading-Done').hide();
             $('#new_family_member_panel').hide();
             $("#add_family_member").click(function(){
                 $('#new_family_member_panel').show();
                 $("#add_family_member").hide();
             });
             $("#btn_save_new_family_member").click(function(){
                 inputsChanged_family_history_form = false;
                 $("#new_family_member_panel").hide();
                 $("#add_family_member").show();
                 $.ajax({
                     url: '{{route('post_new_family_member')}}',
                     data:{
                         relation: $("#relation_family_history").val(),
                         diagnosis_list: $("#search_diagnosis_list_family_history").val(),
                         patient_id:$("#patient_id").val(),
                         user_id: $("#user_id").val(),
                         family_member_status: $(".family_member_status:checked").val(),

                     },
                 });
             });

             $("#btn_cancel_new_family_member").click(function(){
                 $("#new_family_member_panel").hide();
                 $("#add_family_member").show();
             });

             var inputsChanged_personal_history_form = false;
             var inputsChanged_surgical_history_form = false;
             var inputsChanged_social_history_form = false;
             var inputsChanged_family_history_form = false;

             $('#personal_history_form').change(function() {
                 inputsChanged_personal_history_form = true;
             });
             $('#surgical_history_form').change(function() {
                 inputsChanged_surgical_history_form = true;
             });
             $('#social_history_form').change(function() {
                 inputsChanged_social_history_form = true;
             });
             $('#family_history_form').change(function() {
                 inputsChanged_family_history_form = true;
             });

             function unloadPage(){
                 if(inputsChanged_personal_history_form || inputsChanged_family_history_form || inputsChanged_social_history_form || inputsChanged_surgical_history_form||inputsChangedddx||inputchangepicture||inputchangevideo||inputchangeaudio){
                     return "Do you want to leave this page?. Changes you made may not be saved.";
                 }
             }


             $("#btn_save_social_history").click(function(){
                 inputsChanged_social_history_form = false;
             });
             $("#btn_save_personal_history").click(function(){
                 inputsChanged_personal_history_form = false;
             });
             $("#btn_save_surgical_history").click(function(){
                 inputsChanged_surgical_history_form = false;
             });
             $("#btn_save_family_history").click(function(){
                 inputsChanged_family_history_form = false;
             });


        $('#btn_save_all').click(function()
        {
            $('#loading-image').show();
            block_screen();

            $.ajax(
                {
                    type: "POST",
                    url: '{{route('personal_history')}}',
                    data: $("#personal_history_form").serialize()
                });
            $.ajax(
                {
                    type: "POST",
                    url: '{{route('family_history')}}',
                    data: $("#family_history_form").serialize()
                });

            $.ajax(
                {
                    type: "POST",
                    url: '{{route('surgical_history')}}',
                    data: $("#surgical_history_form").serialize()
                });
            $.ajax(
                {
                    type: "POST",
                    url: '{{route('social_history')}}',
                    data: $("#social_history_form").serialize()
                });
            $.ajax({
                url: '{{route('post_new_family_member')}}',
                data: {
                    relation: $("#relation_family_history").val(),
                    diagnosis_list: $("#search_diagnosis_list_family_history").val(),
                    patient_id: $("#patient_id").val(),
                    user_id: $("#user_id").val(),
                    family_member_status: $(".family_member_status:checked").val(),
                },
                success:function () {
                    $("#loading-image").fadeTo("slow", 0);
                    unblock_screen();
                    window.location.reload();

                },
                error:function () {
                    $("#loading-image").fadeTo("slow", 0);
                    unblock_screen();
                    window.location.reload();
                }
            });





//                                                                                  $("#loading-image").fadeTo("slow", 0);
//                                                                                  $("#loading-image").remove();
//                                                                                  $("#loading-Done").fadeIn("slow");
//                                                                                  setTimeout(function(){
//                                                                                      $("#loading-Done").remove();
//                                                                                  }, 1000);
//                                                                                  unblock_screen()
//                                                                                  setTimeout(function(){
//                                                                                      location.reload();
//                                                                                  }, 1000);
//                                                                              }
//                                                                          });
//
//                                                                  }
//
//                                                              }
//                                                          );
//                                                      }
//
//                                              });
//
//                                        }
//                                });
        });







             $("#btn_reset_personal_history").click(function(){
                 $('#search_diagnosis_personal_history').empty().trigger('change');
                 inputsChanged_personal_history_form = false;
             });
             $("#btn_cancel_new_family_member").click(function(){
                 $('#search_diagnosis_list_family_history').empty().trigger('change');
                 inputsChanged_family_history_form = false;
             });
             $("#btn_reset_surgical_history").click(function(){
                 $('#search_diagnosis_surgical_history').empty().trigger('change');
                 inputsChanged_surgical_history_form = false;
             });

             window.onbeforeunload = unloadPage;
         });

function Delete() {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }


     </script>

@endsection
