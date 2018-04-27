@extends('layouts.app')

@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <style type="text/css">
        
    #module_wrap 
{
    margin-top: 0px;  
    margin-bottom: 30px; 
    background: #bdc3c7;
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
    color: #ffffff;
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
            <h3 style="text-align: center"> Instructor Dashboard </h3>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                        <a href="#1" id="expandCollapse" class="btn btn-primary" style="background-color: #337ab7; border: transparent;"><b>-</b> Collapse all Modules</a>
            </div>
            <div class="col-md-7 col-md-offset-1" style=" text-align:right">
                <a class="btn btn-success" href={{url('/ConfigureModules')}}>
                    <i class="fa fa-cog" aria-hidden="true"></i> Configure Modules</a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style="margin-bottom: 0;padding-bottom: 0">
                    <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf); padding-bottom: 0">
                        <h4 style="margin-top: 0">Submitted For Review</h4>
                    </div>
                    <div class="panel-body" style="margin-bottom: 0;padding-bottom: 0">
                        @if($modules_for_review)
                            <?php $modid = 0; ?>
                            @foreach($modules_for_review as $module)
                                <?php $modid = $modid + 1; ?>
                                <div class="panel panel-default" style="border-color: transparent">
                                    <div class="panel-heading" style="padding: 0">
                                        <a href="#0" id="savedModuleName" class="savedModuleCollapse" style="margin-top: 0; text-align: left; padding-left: 25px;">
                                            <span id="<?php echo "plus".$modid; ?>" class="plus fa fa-plus"></span>
                                            <span id="<?php echo "minus".$modid; ?>" class="minus fa fa-minus"></span> {{$module}}</a>
                                    </div>

                                    <div class="panel-body" id="modulepanel">
                                        <div id="module_wrap" class="savedModuleWrapCollapse"> 
                                        @if($for_review_patients)
                                            <table class="table table-striped table-bordered table-hover" style="float: left;">
                                                <thead>
                                                <tr class="bg-custom">
                                                    <th>Patient Name</th>
                                                    <th>Visit Date</th>
                                                    <th>Submitted By</th>
                                                    <th>Submitted On</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                {{--{{$for_review_patients}}--}}
                                                @foreach($for_review_patients as $for_review_patient)
                                                    @if($for_review_patient->patient->module)
                                                        @if($for_review_patient->patient_record_status_id === 2 && $for_review_patient->patient->module->module_name === $module)
                                                            <tr>
                                                                <td>
                                                                    <p id="patientName">
                                                                        <?php echo $for_review_patient->patient->first_name.' '.$for_review_patient->patient->last_name; ?>
                                                                    </p>
                                                                </td>
                                                                <td><p id="visitDate">{{$for_review_patient->patient->visit_date}}</p></td>
                                                                <td><p id="submittedBy">{{$for_review_patient->patient->user->firstname." ".$for_review_patient->patient->user->lastname}}</p></td>

                                                                @if($for_review_patient->updated_at != null)
                                                                    <td><p id="submittedOn">{{($for_review_patient->updated_at)->format('Y-m-d')}}</p></td>
                                                                @else
                                                                    <td><p id="submittedOn"></p></td>
                                                                @endif
                                                                <td style="text-align: right">
                                                                    <a href="{{ route( 'patient_preview', ['patient_id' => $for_review_patient->patient_id ] ) }}" class="btn btn-primary" id="preview">
                                                                        <i class="fa fa-file-text" aria-hidden="true"></i> Print/Preview
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
                            <p>There are no patients for review.</p>
                            <br>
                            <br>
                            <p>{{$for_review_message}}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style="margin-bottom: 0;padding-bottom: 0">
                    <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf); padding-bottom: 0">
                        <h4 style="margin-top: 0">Reviewed Patients</h4>
                    </div>
                    <div class="panel-body" style="margin-bottom: 0;padding-bottom: 0">
                            @if(!empty($reviewed_patients))
                                <?php $modid = 0; ?>
                                @foreach($modules_reviewed as $module)
                                    <?php $modid = $modid + 1; ?>
                                    <div class="panel panel-default" style="border-color: transparent">
                                        <div class="panel-heading" style="padding: 0">
                                            <a href="#0" id="savedModuleName" class="savedModuleCollapse" style="margin-top: 0; text-align: left; padding-left: 25px;">
                                                <span id="<?php echo "pluss".$modid; ?>" class="plus fa fa-plus"></span>
                                                <span id="<?php echo "minuss".$modid; ?>" class="minus fa fa-minus"></span> {{$module}}</a>
                                        </div>
                                        <div class="panel-body" id="modulepanel">
                                            <div id="module_wrap" class="submittedModuleWrapCollapse">
                                            @if($reviewed_patients)
                                                <table class="table table-striped table-bordered table-hover" style="float: left;">
                                                    <thead>
                                                    <tr class="bg-custom">
                                                        <th>Patient Name</th>
                                                        <th>Visit Date</th>
                                                        <th>Submitted By</th>
                                                        <th>Reviewed On</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($reviewed_patients as $reviewed_patient)
                                                        <!-- To check the patient records with "Saved" status -->
                                                        @if($reviewed_patient->patient->module)
                                                            @if($reviewed_patient->patient_record_status_id === 3 && $reviewed_patient->patient->module->module_name === $module)
                                                                <tr>
                                                                    <td>
                                                                        <p id="patientName">
                                                                            <?php echo $reviewed_patient->patient->first_name.' '.$reviewed_patient->patient->last_name; ?>
                                                                        </p>
                                                                    </td>

                                                                    <td><p id="visitDate">{{$reviewed_patient->patient->visit_date}}</p></td>
                                                                    <td><p id="submittedBy">{{$reviewed_patient->patient->user->firstname." ".$reviewed_patient->patient->user->lastname}}</p></td>
                                                                    @if($reviewed_patient->updated_at != null)
                                                                        <td><p id="reviewedOn">{{($reviewed_patient->updated_at)->format('Y-m-d')}}</p></td>
                                                                    @else
                                                                        <td><p id="reviewedOn"></p></td>
                                                                    @endif
                                                                    <td style="text-align: right">
                                                                        <a href="{{ route( 'patient_preview', ['patient_id' => $reviewed_patient->patient_id ] ) }}" class="btn btn-primary" id="preview">
                                                                            <i class="fa fa-file-text" aria-hidden="true"></i> Print/Preview
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
                                <p>There are no reviewed patients</p>
                                <br>
                                <br>
                                <p>{{$reviewed_message}}</p>
                            @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">

        jQuery(document).ready(function($)
{

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
            $("#expandCollapse").html("+ Expand all Modules")
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
            $(".minuss").hide();
            $(".pluss").show();
            $('.savedModuleWrapCollapse').show(); 
            $('.submittedModuleWrapCollapse').show();
      }
});
});

        $('.confirmation').on('click', function () {
            return confirm('Patient will be marked as reviewed. Are you sure?');
        });

    </script>
@endsection