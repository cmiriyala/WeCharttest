@extends('patient.active_record')

@section('documentation_panel')
    {{--Disposition--}}
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf);
padding-bottom: 0">
                <h4 style="margin-top: 0;color:#000; font-weight:500">Disposition<span style="color: red;font-size: large">*</span>

                </h4>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form-horizontal" method="POST" action="{{ route('post_disposition') }}" id="disposition_form">
                    {{ csrf_field() }}
                     <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                     <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                     <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        @foreach ($diagnosis_list_disposition as $diagnosis)
                                            <tr>
                                                <td><p><?php echo ($diagnosis->value); ?></p></td>
                                                <td>
                                                    <a href="{{ route( 'delete_disposition', ['active_record_id' => $diagnosis->active_record_id]) }}"
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
                            
                    <div class="row">
                                <div class="col-md-2">
                                    <label for="Diagnosis"> Diagnosis:</label>
                                </div>
                                <div class="col-md-6">
                                    <select id="search_diagnosis_disposition" class="js-example-basic-multiple js-states form-control " name="search_diagnosis_disposition[]" multiple></select>
                                </div>
                            </div>
                            <br>
                    
                    <div class="container-fluid">
                         <div class="row">
                             <div class="col-md-12">
                                <table class="table table-striped table-bordered table-hover">
                                    <tbody>
                                        <tr>
                                            <td>
                                                @if($disposition_value[0] == 'Discharged')
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="Discharged" checked="checked" id="disposition_discharged" >&nbsp;Discharged                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                @else
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="Discharged" id="disposition_discharged" >&nbsp;Discharged
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if($disposition_value[0] == 'Admitted')
                                                    <input type="radio" class="form-check-input inline" checked="checked" name="disposition" value="Admitted" id="disposition_admitted" >&nbsp;Admitted
                                                @else
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="Admitted" id="disposition_admitted" >&nbsp;Admitted
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if($disposition_value[0] == 'Transferred')
                                                    <input type="radio" class="form-check-input inline" name="disposition" checked="checked" value="Transferred" id="disposition_transferred" >&nbsp;Transferred
                                                @else
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="Transferred" id="disposition_transferred" >&nbsp;Transferred
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if($disposition_value[0] == 'Expired')
                                                    <input type="radio" class="form-check-input inline" name="disposition" checked="checked" value="Expired" id="disposition_expired" >&nbsp;Expired
                                                @else
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="Expired" id="disposition_expired" >&nbsp;Expired
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if($disposition_value[0] == 'AMA')
                                                    <input type="radio" class="form-check-input inline" name="disposition" checked="checked" value="AMA" id="disposition_ama" >&nbsp;AMA
                                                @else
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="AMA" id="disposition_ama" >&nbsp;AMA                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if($disposition_value[0] == 'Eloped')
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="Eloped" checked="checked" id="disposition_eloped" >&nbsp;Eloped                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                @else
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="Eloped" id="disposition_eloped" >&nbsp;Eloped                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if($disposition_value[0] == 'LWBS')
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="LWBS" checked="checked" id="disposition_lwbs" >&nbsp;LWBS                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                @else
                                                    <input type="radio" class="form-check-input inline" name="disposition" value="LWBS" id="disposition_lwbs" >&nbsp;LWBS                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                             </div>
                         </div>
                         <!-- Comment box -->
                         <div class="row">
                             <div class="col-md-12">
                                 <label for="Comment"> Comments:</label>
                                 <br>
                                 @if(!count($disposition_comment)>0)
                                     <textarea rows="4" id="disposition_comment" name="disposition_comment" style="width: 100%;display: block"></textarea>
                                 @else
                                     <textarea rows="4" id="disposition_comment" name="disposition_comment" style="width: 100%;display: block">{{$disposition_comment[0]}}</textarea>
                                 @endif
                             </div>
                        </div>
                         <br>
                         <!-- Buttons -->
                         <div class="row">
                             <div class="col-md-6">
                                 <button type="reset" id="btn_reset_disposition" class="btn btn-success" style="float: left">
                                     <i class="fa fa-refresh" aria-hidden="true"></i> Reset Disposition
                                 </button>
                             </div>
                             <div class="col-sm-6">
                                 <button type="submit" id="btn_save_disposition" class="btn btn-primary"  style="float: right">
                                     <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Disposition
                                 </button>
                             </div>
                         </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#search_diagnosis_disposition').select2({
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
        $(document).ready(function(){
            var inputsChanged = false;
            $('#disposition_form').change(function() {
                inputsChanged = true;
            });

            function unloadPage(){
                if(inputsChanged||inputsChangedddx||inputchangepicture||inputchangevideo||inputchangeaudio){
                    return "Do you want to leave this page?. Changes you made may not be saved.";
                }
            }

            $("#btn_save_disposition").click(function(){
                inputsChanged = false;
            });

            $('#btn_reset_disposition').click( function()
            {
                $('#search_diagnosis_disposition').empty().trigger('change');
                $('#disposition_comment').val('');
                $('#btn_save_disposition').prop('disabled', false);
                $('.form-check-input').prop('checked',false);
                inputsChanged = false;
            } );
            window.onbeforeunload = unloadPage;
        });

        $('.form-check-input').click( function()
        {
            $('#btn_save_disposition').prop('disabled', false);
        } );

function Delete() {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

@endsection