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
        #MyButton{
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

    @if(in_array("10", $navIds))
        {{--ros_constitutional--}}
        <div class="col-md-6" id="constitutional">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Constitutional</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_constitutional') }}" id="ros_constitutional_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_constitutional_symptoms as $ros_constitutional_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_constitutional_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_constitutional_symptoms[]"
                                                                value="{{$ros_constitutional_symptom->value}}"
                                                                id="{{$ros_constitutional_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_constitutional_symptoms[]"
                                                                value="{{$ros_constitutional_symptom->value}}"
                                                                id="{{$ros_constitutional_symptom->value}}">

                                                    @endif
                                                    {{$ros_constitutional_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_constitutional_comment)>0)
                                        <textarea rows="4" id="ros_constitutional_comment" name="ros_constitutional_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_constitutional_comment" name="ros_constitutional_comment" style="width: 100%;display: block">{{$ros_constitutional_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-5">
                                    <button type="reset" id="btn_clear_ros_constitutional" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Constitutional
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-5" >
                                    <button type="submit" id="btn_save_ros_constitutional" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Constitutional
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        
        </div>
        
    @endif
    @if(in_array("11", $navIds))
        {{--ros_hent--}}
        
        <div class="col-md-6" id="hent">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- HENT</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_hent') }}" id="ros_hent_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            @foreach ($ros_hent_symptoms as $ros_hent_symptom)
                                                <tr>
                                                    <td>
                                                        @if($ros_hent_symptom->is_saved)
                                                            <input
                                                                    type="checkbox"
                                                                    name="$ros_hent_symptoms[]"
                                                                    value="{{$ros_hent_symptom->value}}"
                                                                    id="{{$ros_hent_symptom->value}}" checked>
                                                        @else
                                                            <input
                                                                    type="checkbox"
                                                                    name="$ros_hent_symptoms[]"
                                                                    value="{{$ros_hent_symptom->value}}"
                                                                    id="{{$ros_hent_symptom->value}}">

                                                        @endif
                                                        {{$ros_hent_symptom->value}}
                                                        <br>
                                                        <br>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                        </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_hent_comment)>0)
                                        <textarea rows="4" id="ros_hent_comment" name="ros_hent_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_hent_comment" name="ros_hent_comment" style="width: 100%;display: block">{{$ros_hent_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_hent" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset HENT
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_hent" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save HENT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
    @endif
    @if(in_array("12", $navIds))
        {{--ros_eyes--}}
        
        <div class="col-md-6" id="eyes">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);
padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Eyes</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_eyes') }}" id="ros_eyes_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_eyes_symptoms as $ros_eyes_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_eyes_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_eyes_symptoms[]"
                                                                value="{{$ros_eyes_symptom->value}}"
                                                                id="{{$ros_eyes_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_eyes_symptoms[]"
                                                                value="{{$ros_eyes_symptom->value}}"
                                                                id="{{$ros_eyes_symptom->value}}">

                                                    @endif
                                                    {{$ros_eyes_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_eyes_comment)>0)
                                        <textarea rows="4" id="ros_eyes_comment" name="ros_eyes_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_eyes_comment" name="ros_eyes_comment" style="width: 100%;display: block">{{$ros_eyes_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_eyes" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Eyes
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_eyes" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Eyes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
        
    @endif
    @if(in_array("13", $navIds))
        {{--ros_respiratory--}}
        
        <div class="col-md-6" id="respiratory">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);
padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Respiratory</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_respiratory') }}" id="ros_respiratory_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_respiratory_symptoms as $ros_respiratory_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_respiratory_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_respiratory_symptoms[]"
                                                                value="{{$ros_respiratory_symptom->value}}"
                                                                id="{{$ros_respiratory_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_respiratory_symptoms[]"
                                                                value="{{$ros_respiratory_symptom->value}}"
                                                                id="{{$ros_respiratory_symptom->value}}">

                                                    @endif
                                                    {{$ros_respiratory_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_respiratory_comment)>0)
                                        <textarea rows="4" id="ros_respiratory_comment" name="ros_respiratory_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_respiratory_comment" name="ros_respiratory_comment" style="width: 100%;display: block">{{$ros_respiratory_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_respiratory" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Respiratory
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_respiratory" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Respiratory
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
        
    @endif
    
    @if(in_array("15", $navIds))
        {{--ros_musculosketal--}}
        
        <div class="col-md-6" id="musculoskeletal">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Musculoskeletal</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_musculoskeletal') }}" id="ros_musculoskeletal_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                     <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_musculoskeletal_symptoms as $ros_musculoskeletal_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_musculoskeletal_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_musculoskeletal_symptoms[]"
                                                                value="{{$ros_musculoskeletal_symptom->value}}"
                                                                id="{{$ros_musculoskeletal_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_musculoskeletal_symptoms[]"
                                                                value="{{$ros_musculoskeletal_symptom->value}}"
                                                                id="{{$ros_musculoskeletal_symptom->value}}">

                                                    @endif
                                                    {{$ros_musculoskeletal_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_musculoskeletal_comment)>0)
                                        <textarea rows="4" id="ros_musculoskeletal_comment" name="ros_musculoskeletal_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_musculoskeletal_comment" name="ros_musculoskeletal_comment" style="width: 100%;display: block">{{$ros_musculoskeletal_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_musculoskeletal" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Musculoskeletal
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_musculoskeletal" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Musculoskeletal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
        
    @endif
    @if(in_array("16", $navIds))
        {{--ros_integumentary--}}
        
        <div class="col-md-6" id="integumentary">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Integumentary</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_integumentary') }}" id="ros_integumentary_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                   <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_integumentary_symptoms as $ros_integumentary_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_integumentary_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_integumentary_symptoms[]"
                                                                value="{{$ros_integumentary_symptom->value}}"
                                                                id="{{$ros_integumentary_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_integumentary_symptoms[]"
                                                                value="{{$ros_integumentary_symptom->value}}"
                                                                id="{{$ros_integumentary_symptom->value}}">

                                                    @endif
                                                    {{$ros_integumentary_symptom->value}}
                                                    <br>
                                                    <br>

                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                          
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_integumentary_comment)>0)
                                        <textarea rows="4" id="ros_integumentary_comment" name="ros_integumentary_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_integumentary_comment" name="ros_integumentary_comment" style="width: 100%;display: block">{{$ros_integumentary_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_integumentary" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Integumentary
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_integumentary" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Integumentary
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
        
    @endif
    @if(in_array("17", $navIds))
        {{--ros_neurological--}}
        
        <div class="col-md-6" id="neurological">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);
padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Neurological</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_neurological') }}" id="ros_neurological_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_neurological_symptoms as $ros_neurological_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_neurological_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_neurological_symptoms[]"
                                                                value="{{$ros_neurological_symptom->value}}"
                                                                id="{{$ros_neurological_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_neurological_symptoms[]"
                                                                value="{{$ros_neurological_symptom->value}}"
                                                                id="{{$ros_neurological_symptom->value}}">

                                                    @endif
                                                    {{$ros_neurological_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_neurological_comment)>0)
                                        <textarea rows="4" id="ros_neurological_comment" name="ros_neurological_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_neurological_comment" name="ros_neurological_comment" style="width: 100%;display: block">{{$ros_neurological_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_neurological" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Neurological
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_neurological" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Neurological
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
        
    @endif
    @if(in_array("18", $navIds))
        {{--ros_psychological--}}
        
        <div class="col-md-6" id="psychological">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);
padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Psychological</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_psychological') }}" id="ros_psychological_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_psychological_symptoms as $ros_psychological_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_psychological_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_psychological_symptoms[]"
                                                                value="{{$ros_psychological_symptom->value}}"
                                                                id="{{$ros_psychological_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_psychological_symptoms[]"
                                                                value="{{$ros_psychological_symptom->value}}"
                                                                id="{{$ros_psychological_symptom->value}}">

                                                    @endif
                                                    {{$ros_psychological_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_psychological_comment)>0)
                                        <textarea rows="4" id="ros_psychological_comment" name="ros_psychological_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_psychological_comment" name="ros_psychological_comment" style="width: 100%;display: block">{{$ros_psychological_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_psychological" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Psychological
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_psychological" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Psychological
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        

    @endif
    
    @if(in_array("19", $navIds))
        {{--ros_gastrointestinal--}}
        <div class="col-md-6" id="gastrointestinal">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);
padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Gastrointestinal</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_gastrointestinal') }}" id="ros_gastrointestinal_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_gastrointestinal_symptoms as $ros_gastrointestinal_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_gastrointestinal_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_gastrointestinal_symptoms[]"
                                                                value="{{$ros_gastrointestinal_symptom->value}}"
                                                                id="{{$ros_gastrointestinal_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_gastrointestinal_symptoms[]"
                                                                value="{{$ros_gastrointestinal_symptom->value}}"
                                                                id="{{$ros_gastrointestinal_symptom->value}}">

                                                    @endif
                                                    {{$ros_gastrointestinal_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_gastrointestinal_comment)>0)
                                        <textarea rows="4" id="ros_gastrointestinal_comment" name="ros_gastrointestinal_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_gastrointestinal_comment" name="ros_gastrointestinal_comment" style="width: 100%;display: block">{{$ros_gastrointestinal_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_gastrointestinal" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Gastrointestinal
                                    </button>
                                </div>
                            </div>
                                <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_gastrointestinal" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Gastrointestinal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    @endif

    @if(in_array("14", $navIds))
        {{--ros_cardiovascular--}}
        
        <div class="col-md-6" id="cardiovascular">
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);
padding-bottom: 0">
                    <h4 style="margin-top: 0;color:#000; font-weight:500">ROS- Cardiovascular</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_cardiovascular') }}" id="ros_cardiovascular_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_cardiovascular_symptoms as $ros_cardiovascular_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_cardiovascular_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_cardiovascular_symptoms[]"
                                                                value="{{$ros_cardiovascular_symptom->value}}"
                                                                id="{{$ros_cardiovascular_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_cardiovascular_symptoms[]"
                                                                value="{{$ros_cardiovascular_symptom->value}}"
                                                                id="{{$ros_cardiovascular_symptom->value}}">

                                                    @endif
                                                    {{$ros_cardiovascular_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Comment box -->
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="Comment"> Comments:</label>
                                    <br>
                                    @if(!count($ros_cardiovascular_comment)>0)
                                        <textarea rows="4" id="ros_cardiovascular_comment" name="ros_cardiovascular_comment" style="width: 100%;display: block"></textarea>
                                    @else
                                        <textarea rows="4" id="ros_cardiovascular_comment" name="ros_cardiovascular_comment" style="width: 100%;display: block">{{$ros_cardiovascular_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_cardiovascular" class="btn btn-success" style="float: left">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Reset Cardiovascular
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6" >
                                    <button type="submit" id="btn_save_ros_cardiovascular" class="btn btn-primary" style="float: left">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Cardiovascular
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
    <button type="submit" id="MyButton" class="btn btn-primary btn-lg btn-block">
    	<center><i class="fa fa-floppy-o" aria-hidden="true"></i> Save ROS</center>
    </button>


    <script>
        $(document).ready(function(){
            $('#loading-image').hide();
            $('#loading-Done').hide();
            var Arraytrue = new Array();
            var inputsChanged_ros_constitutional_form = false;
            $('#ros_constitutional_form').change(function() {
                inputsChanged_ros_constitutional_form = true;
                Arraytrue.inputsChanged_ros_constitutional_form= true;
            });
            var inputsChanged_ros_hent_form = false;
            $('#ros_hent_form').change(function() {
                inputsChanged_ros_hent_form = true;
                Arraytrue.inputsChanged_ros_hent_form = true;
            });

            var inputsChanged_ros_eyes_form = false;
            $('#ros_eyes_form').change(function() {
                inputsChanged_ros_eyes_form = true;
                Arraytrue.inputsChanged_ros_eyes_form = true;
            });
            var inputsChanged_ros_respiratory_form = false;
            $('#ros_respiratory_form').change(function() {
                inputsChanged_ros_respiratory_form = true;
                Arraytrue.inputsChanged_ros_respiratory_form = true;
            });
            var inputsChanged_ros_cardiovascular_form = false;
            $('#ros_cardiovascular_form').change(function() {
                inputsChanged_ros_cardiovascular_form = true;
                Arraytrue.inputsChanged_ros_cardiovascular_form = true;
            });

            var inputsChanged_ros_musculoskeletal_form = false;
            $('#ros_musculoskeletal_form').change(function() {
                inputsChanged_ros_musculoskeletal_form = true;
                Arraytrue.inputsChanged_ros_musculoskeletal_form = true;
            });
            var inputsChanged_ros_integumentary_form = false;
            $('#ros_integumentary_form').change(function() {
                inputsChanged_ros_integumentary_form = true;
                Arraytrue.inputsChanged_ros_integumentary_form = true;
            });
            var inputsChanged_ros_neurological_form = false;
            $('#ros_neurological_form').change(function() {
                inputsChanged_ros_neurological_form = true;
                Arraytrue.inputsChanged_ros_neurological_form = true;
            });
            var inputsChanged_ros_psychological_form = false;
            $('#ros_psychological_form').change(function() {
                inputsChanged_ros_psychological_form = true;
                Arraytrue.inputsChanged_ros_psychological_form = true;
            });
            var inputsChanged_ros_gastrointestinal_form = false;
            $('#ros_gastrointestinal_form').change(function() {
                inputsChanged_ros_gastrointestinal_form = true;
                Arraytrue.inputsChanged_ros_gastrointestinal_form = true;
            });


            function unloadPage(){
                if(inputsChanged_ros_constitutional_form || inputsChanged_ros_hent_form || inputsChanged_ros_eyes_form || inputsChanged_ros_respiratory_form 
                || inputsChanged_ros_cardiovascular_form || inputsChanged_ros_musculoskeletal_form || inputsChanged_ros_integumentary_form || inputsChanged_ros_neurological_form || inputsChanged_ros_psychological_form||inputsChangedddx||inputchangepicture||inputchangevideo||inputchangeaudio){
                    return "Do you want to leave this page?. Changes you made may not be saved.";
                }
            }
            $("#btn_save_ros_constitutional").click(function(){
                inputsChanged_ros_constitutional_form = false;
            });
            $("#btn_save_ros_hent").click(function(){
                inputsChanged_ros_hent_form = false;
            });
            $("#btn_save_ros_eyes").click(function(){
                inputsChanged_ros_eyes_form = false;
            });
            $("#btn_save_ros_respiratory").click(function(){
                inputsChanged_ros_respiratory_form = false;
            });
            $("#btn_save_ros_cardiovascular").click(function(){
                inputsChanged_ros_cardiovascular_form = false;
            });
            $("#btn_save_ros_musculoskeletal").click(function(){
                inputsChanged_ros_musculoskeletal_form = false;
            });
            $("#btn_save_ros_integumentary").click(function(){
                inputsChanged_ros_integumentary_form = false;
            });
            $("#btn_save_ros_neurological").click(function(){
                inputsChanged_ros_neurological_form = false;
            });
            $("#btn_save_ros_psychological").click(function(){
                inputsChanged_ros_psychological_form = false;
            });
            $("btn_save_ros_gastrointestinal").click(function() {
                inputsChanged_ros_gastrointestinal_form = false;
            });
            // Reset buttons
            $("#btn_clear_ros_constitutional").click(function(){
                inputsChanged_ros_constitutional_form = false;
            });
            $("#btn_clear_ros_hent").click(function(){
                inputsChanged_ros_hent_form = false;
            });
            $("#btn_clear_ros_eyes").click(function(){
                inputsChanged_ros_eyes_form = false;
            });
            $("#btn_clear_ros_respiratory").click(function(){
                inputsChanged_ros_respiratory_form = false;
            });
            $("#btn_clear_ros_cardiovascular").click(function(){
                inputsChanged_ros_cardiovascular_form = false;
            });
            $("#btn_clear_ros_musculoskeletal").click(function(){
                inputsChanged_ros_musculoskeletal_form = false;
            });
            $("#btn_clear_ros_integumentary").click(function(){
                inputsChanged_ros_integumentary_form = false;
            });
            $("#btn_clear_ros_neurological").click(function(){
                inputsChanged_ros_neurological_form = false;
            });
            $("#btn_clear_ros_psychological").click(function(){
                inputsChanged_ros_psychological_form = false;
            });
            $("#btn_clear_ros_gastrointestinal").click(function(){
                inputsChanged_ros_gastrointestinal_form = false;
            });

            $('#MyButton').click(function() {
                console.log(Arraytrue);
                //alert(Arraytrue.inputsChanged_ros_cardiovascular_form);
                form1 = $('#ros_constitutional_form');
                form2 = $('#ros_hent_form');
                form3 = $('#ros_eyes_form');
                form4 = $('#ros_respiratory_form');
                form5 = $('#ros_musculoskeletal_form');
                form6 = $('#ros_integumentary_form');
                form7 = $('#ros_neurological_form');
                form8 = $('#ros_psychological_form');
                form9 = $('#ros_gastrointestinal_form');
                form10 = $('#ros_cardiovascular_form');
                $('#loading-image').show();
                block_screen();
                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_constitutional') }}',
                        data: form1.serialize(),
                    });
                        $.ajax({
                            type: "POST",
                            url: '{{ route('ros_hent') }}',
                            data: form2.serialize(),
                        });
                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_eyes') }}',
                        data: form3.serialize(),
                    });
                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_respiratory') }}',
                        data: form4.serialize(),
                    });

                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_musculoskeletal') }}',
                        data: form5.serialize(),
                        });
                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_integumentary') }}',
                        data: form6.serialize(),
                    });
                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_neurological') }}',
                        data: form7.serialize(),
                        });

                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_psychological') }}',
                        data: form8.serialize(),
                    });
                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_gastrointestinal') }}',
                        data: form9.serialize(),
                    });

                    $.ajax({
                        type: "POST",
                        url: '{{ route('ros_cardiovascular') }}',
                        data: form10.serialize(),
                        success:function () {
                            $("#loading-image").remove();
                            unblock_screen();
                            window.location.reload();

                        },
                        error:function () {
                            $("#loading-image").remove();
                            unblock_screen();
                            window.location.reload();
                        }
                    });








                                                                                               // $('#loading-image').show();
                                                                                               /* $("#loading-image").fadeTo("slow", 0);
                                                                                                $("#loading-image").remove();
                                                                                                $("#loading-Done").fadeIn("slow");
                                                                                                setTimeout(function(){
                                                                                                    $("#loading-Done").remove();
                                                                                                }, 1000);
                                                                                                unblock_screen()
                                                                                                setTimeout(function(){

                                                                                                }, 1000);

                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            }
                                                                        });
                                                                    }
                                                                });
                                                            }
                                                        });
                                                    }
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });*/

            });

            window.onbeforeunload = unloadPage;
        });

    </script>

@endsection