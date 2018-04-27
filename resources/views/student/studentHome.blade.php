@extends('layouts.app')

@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <style type="text/css">

        #module_wrap
        {
            margin-top: 0px;
            margin-bottom: 30px;
            background: linear-gradient(#FFE8C3, #f7f5be);
            width: auto; height: 50px;
        }



        #savedModuleName
        {
            display: block;
            width: 100%;
            height: 35px;
            line-height: 35px;
            background: linear-gradient(#ffe4ba, #f4f2b2);
            text-align: center;
            color: #000000;
            font-weight: bold;
            font-variant: small-caps;
            box-shadow: 2px 2px 3px #888888;
            text-decoration:none;
        }

        #savedModuleName:hover
        {
            text-decoration:none;
            border-top: 1px groove white;
            border-left: 1px groove white;
            border-bottom: 1px solid #7B7B78;
            border-right: 1px solid #7B7B78;
            color: #6d6f71;
            background: linear-gradient(#ffe4ba, #f4f2b2);
            box-shadow: 1px 1px 2px #888888;
        }

        #heading{
            margin: auto;
            width: 60%;
            padding: 10px;
        }


    </style>

    <div class="container">
        <div class="row">
            <h3 style="text-align: center"> <b>Student Dashboard </b></h3>
        </div>
        <!-- This button will take the user to a new page where new patient's demographic will be entered -->
        <div class="row">
            <div class="col-md-2 col-md-offset-1" >
                <a href="#0" id="expandCollapse" class="btn btn-primary" style=" border: transparent;"><b>-</b> Collapse all Modules</a>
            </div>
            <div class="col-md-7 col-md-offset-1">
                <a id="addPatient" href="{{url('/add_patient')}}" class="btn btn-success" style="float: right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Add new Patient</a>
            </div>
        </div>
        <br>
        <!-- Saved -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style="margin-bottom: 0;padding-bottom: 0">
                    <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf); padding-bottom: 0">
                        <div class="row">
                            <div class="col-md-2" style="float: left;">
                                <h4 style="margin-top: 0; padding-top: 6px; color:#000; font-weight:500">Saved Patients</h4>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body" style="margin-bottom: 0;padding-bottom: 0">
                        @if(count($saved_patients_modules)>0)
                            <?php $modid = 0; ?>
                            @foreach($saved_patients_modules as $module)
                                <?php $modid = $modid + 1; ?>
                                <div class="panel panel-default" style="border-color: transparent" >
                                    <div class="panel-heading" style="padding: 0">
                                        <a href="#0" id="savedModuleName" class="savedModuleCollapse" style="margin-top: 0; text-align: left; padding-left: 25px;">
                                            <span id="<?php echo "plus".$modid; ?>" class="plus fa fa-plus"></span>
                                            <span id="<?php echo "minus".$modid; ?>" class="minus fa fa-minus"></span> {{$module}}</a>
                                    </div>

                                    <div class="panel-body" id="modulepanel">
                                        <div id="module_wrap" class="savedModuleWrapCollapse">
                                            @if($saved_patients)
                                                <table class="table table-striped table-bordered table-hover" style="float: left;">
                                                    <thead>
                                                    <tr class="bg-custom">
                                                        <th>Patient Name</th>
                                                        <th>Age</th>
                                                        {{--<th>Sex</th>--}}
                                                        <th>Visit Date</th>
                                                        <th style="text-align:center">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($saved_patients as $patient)
                                                        <!-- To check the patient records with "Saved" status -->
                                                        @if($patient->module)
                                                            @if($patient->status === 1 && $patient->module->module_name === $module)
                                                                <tr>
                                                                    <td class="text-danger">
                                                                        <a href="{{ route( 'patient.view', ['patient_id' => $patient->patient_id ] ) }}" id="patientName" class="text-secondary">
                                                                            <b><?php echo $patient->first_name.' '.$patient->last_name; ?></b>
                                                                        </a>
                                                                    </td>
                                                                    <td><p id="patientAge">{{$patient->age}}</p></td>
                                                                    {{--<td><p id="patientSex">{{$patient->gender}}</p></td>--}}
                                                                    <td><p id="visitDate">{{$patient->visit_date}}</p></td>
                                                                    <td style="text-align: center">

                                                                        <a href="{{ route( 'patient.destroy', ['patient_id' => $patient->patient_id]) }}" class="btn btn-danger confirmation" id="delete" onclick="return Delete()">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>{{$saved_message}}</p>
                            <br><br><br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Submitted -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style="margin-bottom: 0;padding-bottom: 0">
                    <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf); padding-bottom: 0">
                        <h4 style="margin-top: 0; color:#000; font-weight:500">Submitted Patients</h4>
                    </div>
                    <div class="panel-body" style="margin-bottom: 0;padding-bottom: 0">
                        @if(count($submitted_patients_modules)>0)
                            <?php $modid = 0; ?>
                            @foreach($submitted_patients_modules as $module)
                                <?php $modid = $modid + 1; ?>
                                <div class="panel panel-default" style="border-color: transparent">
                                    <div class="panel-heading" style="padding: 0;">
                                        <a href="#0" id="savedModuleName" class="savedModuleCollapse" style="margin-top: 0; text-align: left; padding-left: 25px;"><span id="<?php echo "pluss".$modid; ?>" class="plus fa fa-plus"></span><span id="<?php echo "minuss".$modid; ?>" class="minus fa fa-minus"></span> {{$module}}</a>
                                    </div>

                                    <div class="panel-body" id="modulepanel">
                                        <div id="module_wrap" class="submittedModuleWrapCollapse">
                                            @if($submitted_patients)
                                                <table class="table table-striped table-bordered table-hover" style="float: left;">
                                                    <thead>
                                                    <tr class="bg-custom">
                                                        <th>Patient Name</th>
                                                        <th>Submitted Date</th>
                                                        <th>Visit Date</th>
                                                        <th style="text-align:center">Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($submitted_patients as $patient)
                                                        <!-- To check the patient records with "Saved" status -->
                                                        @if($patient->module)
                                                            @if($patient->completed_flag == 1 && $patient->module->module_name === $module)
                                                                <tr>
                                                                    <td>
                                                                        <b><?php echo $patient->first_name.' '.$patient->last_name; ?></b>
                                                                    </td>
                                                                    <td><p id="patient_submitted_date">{{$patient->submitted_date}}</p></td>
                                                                    <td><p id="visitDate">{{$patient->visit_date}}</p></td>
                                                                    <td style="text-align: center">
                                                                        <a href="{{ route( 'student_preview', ['patient_id' => $patient->patient_id ] ) }}" class="btn btn-primary" id="preview">
                                                                            <i class="fa fa-file-text" aria-hidden="true"></i> Print/Preview
                                                                        </a>
                                                                        <a href="{{ route( 'patient.destroy', ['patient_id' => $patient->patient_id]) }}" class="btn btn-danger confirmation" id="delete" onclick="return Delete()">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>{{$submitted_message}}</p>
                            <br><br><br>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
    </div>

    <script type="text/javascript">

        jQuery(document).ready(function($)
        {
            if(!!window.performance && window.performance.navigation.type === 2)
            {
                console.log('Reloading');
                window.location.reload();
            }

            $(".plus").hide();
            $(".pluss").hide();
            $('a[id^="savedModuleName"]').click(function()
            {
                var clicks = $(this).data('clicks');

                if($(this).children('.minus').css('display') == 'none')
                {
                    var n= $(this).children('.plus').attr("id");
                    var m= $(this).children('.minus').attr("id");
                    var idn="#"+n;
                    var idm="#"+m;
                    $(idn).hide();
                    $(idm).show();
                    $("#expandCollapse").html("- Collapse all Modules");
                }
                else
                {
                    var n= $(this).children('.plus').attr("id");
                    var m= $(this).children('.minus').attr("id");
                    var idn="#"+n;
                    var idm="#"+m;
                    $(idn).show();
                    $(idm).hide();
                    $("#expandCollapse").html("+ Expand all Modules");

                }
                if($(this).children('.minuss').css('display') == 'none')
                {
                    var x= $(this).children('.pluss').attr("id");
                    var y= $(this).children('.minuss').attr("id");
                    var idx="#"+x;
                    var idy="#"+y;
                    $(idx).hide();
                    $(idy).show();
                }
                else
                {
                    var x= $(this).children('.pluss').attr("id");
                    var y= $(this).children('.minuss').attr("id");
                    var idx="#"+x;
                    var idy="#"+y;
                    $(idx).show();
                    $(idy).hide();
                }
                $(this).data("clicks", !clicks);

                $(this).closest('.panel').children("#modulepanel").children("#module_wrap").slideToggle( "slow");
            });
            $('a[id^="expandCollapse"]').click(function()
            {
                if ($("#expandCollapse").text() == "- Collapse all Modules")
                {
                    $("#expandCollapse").html("+ Expand all Modules");
                    $(".minus").hide();
                    $(".plus").show();
                    $(".minuss").hide();
                    $(".pluss").show();
                    $('.savedModuleWrapCollapse').hide();
                    $('.submittedModuleWrapCollapse').hide();
                }
                else
                {
                    $("#expandCollapse").text("- Collapse all Modules");
                    $(".minus").show();
                    $(".plus").hide();
                    $(".minuss").show();
                    $(".pluss").hide();
                    $('.savedModuleWrapCollapse').show();
                    $('.submittedModuleWrapCollapse').show();
                }
            });
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