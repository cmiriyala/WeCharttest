@extends('patient.active_record')

@section('documentation_panel')
    {{--@parent--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);padding-bottom: 0">
                        <h4 style="margin-top: 0;color:#000; font-weight:500" id="hpi_heading">Vital Signs</h4>
                    </div>

                    <div class="panel-body col-md-offset">
                        <div style="float: left">
                            <button type="submit" id="btn_add_vital_signs" class="btn btn-primary">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Vital Signs
                            </button>
                        </div>
                        <br><br>
                        <div class="row" style="overflow-x: auto;width: 100%; display: block">
                            <table class="table table-striped table-bordered table-hover" style="margin-top:10px; margin-left:15px;" id="vital_signs_table">
                                <thead>
                                <tr class="bg-warning">
                                    <th>Timestamp</th>
                                    <th>BP Systolic</th>
                                    <th>BP Diastolic</th>
                                    <th>Heart Rate</th>
                                    <th>Respiratory Rate</th>
                                    <th>Temperature</th>
                                    <th>Weight</th>
                                    <th>Height</th>
                                    <th>Pain (0/10)</th>
                                    <th>O<sub>2</sub> Sat</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--Checking for no records--}}
                                @if(!count($vital_sign_details)> 0)
                                    <tr>
                                        <td colspan="12" style="text-align: center">
                                            <br>
                                            <b>There are no vital signs.</b>
                                            <br>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($vital_sign_details as $vs)
                                        <tr>
                                            <td>
                                                {{ $vs->timestamp }}
                                            </td>
                                            <td>
                                                @if(count($vs->BP_Systolic)>0)
                                                    {{ $vs->BP_Systolic[0] }}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->BP_Diastolic)>0)
                                                    {{$vs->BP_Diastolic[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->Heart_Rate)>0)
                                                    {{$vs->Heart_Rate[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->Respiratory_Rate)>0)
                                                    {{$vs->Respiratory_Rate[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->Temperature)>0)
                                                    {{$vs->Temperature[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->Weight)>0)
                                                    {{$vs->Weight[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->Height)>0)
                                                    {{$vs->Height[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->Pain)>0)
                                                    {{$vs->Pain[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->Oxygen_Saturation)>0)
                                                    {{$vs->Oxygen_Saturation[0]}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($vs->Comment)>0)
                                                    {{$vs->Comment[0]}}
                                                @endif
                                            </td>
                                             <td>
                                                 {{ Form::open(array('method' => 'post', 'route' => array('delete_vital_signs', $vs->timestamp))) }}
                                                 <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                                                 <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                                 <button name="delbutton" class="btn btn-danger btn-delete enable btn-sm" id="delete_vital_signs" onclick="return Delete()"><i class="fa fa-trash-o" aria-hidden="true"></i>
</button>
                                                 {{ Form::close() }}                                               
                                             </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <br><br>

                        <div class="row" style="overflow-x: auto;width: 100%;display: block" id="table_child_vital_signs">
                            <form class="form-horizontal" method="POST" action="{{ url('post_vital_signs') }}" id="vitals_form">
                                {{ csrf_field() }}
                                <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                                <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                <!-- <input id="timestamp" name="timestamp" type="hidden"> -->
                                <table class="table table-striped table-bordered table-hover" style="margin-top:10px; margin-left:15px;">
                                    <tr style="background: lightblue">
                                        <th>BP Systolic</th>
                                        <th>BP Diastolic</th>
                                        <th>Heart Rate</th>
                                        <th>Respiratory Rate</th>
                                        <th>Temperature</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Pain (0/10)</th>
                                        <th>O<sub>2</sub> Sat</th>
                                        <th>Comment</th>
                                        <th></th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="text" name="BP_Systolic" id="BP_Systolic" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="BP_Diastolic" id="BP_Diastolic" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Heart_Rate" id="Heart_Rate" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Respiratory_Rate" id="Respiratory_Rate" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Temperature" id="Temperature" style="width: 100px;">
                                            <select name="temperature_unit" id = "temperature_unit">
                                                <option value=""></option>
                                                <option value="F">F</option>
                                                <option value="C">C</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="Weight" id="Weight" style="width: 100px;">
                                            <select name="weight_unit" id = "weight_unit">
                                                <option value=""></option>
                                                <option value="kgs">kgs</option>
                                                <option value="lbs">lbs</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="Height" id="Height" style="width: 100px;">
                                            <select name="height_unit" id="height_unit">
                                                <option value=""></option>
                                                <option value="cms">cms</option>
                                                <option value="inches">inches</option>
                                            </select>
                                        </td>
                                        <td>
                                            <!-- Pain Scale 0-10  -->
                                            <!-- <input type="number" name="Pain" id="Pain" style="width: 100px;" min="0" max="10"  oninput="this.value=this.value.replace(/[^0-9]/g,''); "> -->
                                            <input type="text" name="Pain" id="Pain" style="width: 100px" maxlength="2" pattern="(10|([0-9]))"  oninvalid="this.setCustomValidity('Enter value between 0 to 10')" oninput="setCustomValidity('')" >

                                        </td>
                                        <td>
                                            <input type="text" name="Oxygen_Saturation" id="Oxygen_Saturation" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Comments" id="Comments" style="width: 100px;">
                                        </td>
                                        <td>
                                            <button name="submitbutton" id="btn_save_vitals" class="btn btn-success btn-submit btn-sm"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
                                        </td>
                                    </tr>

                                </table>
                                <a href="#" title="" class="btn btn-primary" id="cancel_add_vital_signs" style="float: left; margin-left:15px;">
                                    <i class="fa fa-ban" aria-hidden="true"></i> Cancel</a>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var pin = document.getElementById("Pain");

            pin.addEventListener("input",function (event) {
                if(pin.validity.typeMismatch){
                    pin.setCustomValidity("Enter values from 0 to 10");
                }
                else{
                    pin.setCustomValidity("");
                }
            });

        $(document).ready(function(){

            $('#table_child_vital_signs').hide();
            $("#btn_add_vital_signs").click(function(){
                //$('#onetimedisplay').hide();
                $('#table_child_vital_signs').show();
                $("#btn_add_vital_signs").hide();
            });

            var inputsChanged = false;
            $('#vitals_form').change(function() {
                inputsChanged = true;
            });
            function unloadPage(){
                if(inputsChanged||inputsChangedddx||inputchangepicture||inputchangevideo||inputchangeaudio){
                    return "Do you want to leave this page?. Changes you made may not be saved.";
                }
            }
            $("#btn_save_vitals").click(function(){
                inputsChanged = false;
            });
            window.onbeforeunload = unloadPage;
        });
        $("#cancel_add_vital_signs").click(function(){
            $('#table_child_vital_signs').hide();
            $("#btn_add_vital_signs").show();
            $('#BP_Diastolic').val('');
            $('#BP_Systolic').val('');
            $('#Heart_Rate').val('');
            $('#Respiratory_Rate').val('');
            $('#Temperature').val('');
            $('#temperature_unit').val('');
            $('#Height').val('');
            $('#height_unit').val('');
            $('#Weight').val('');
            $('#weight_unit').val('');
            $('#Pain').val('');
            $('#Oxygen_Saturation').val('');
            $('#Comments').val('');
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
