{{--@extends('layouts.app')--}}
{{--@extends('patient.vital_signs_header')--}}
@extends('patient.active_record')

@section('documentation_panel')
    {{--@parent--}}
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                <h4 style="margin-top: 0">Orders</h4>
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('post_orders') }}" id="orders_form">
                {{ csrf_field() }}
                <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6">

                                <div class="row">
                                    <div class="col-sm-6">
                                    <label for="orders_medication"> Medications:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                    <select id="search_labs_medication" class="js-example-basic-multiple js-states form-control" name="search_labs_medication[]" multiple></select>
                                    </div>
                                </div>

                        </div>  
                    </div><br>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="bg-info">
                                    <th>List of Medications</th>
                                    <th colspan="20">Dosage</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach ($medications as $medicine)
                                        <tr>
                                            <td><p>{{$medicine->value}}</p></td>
                                            @if($medicine->dosage==null)
                                                <td colspan="20"><input type="text" id="Dosage" name="Dosage[]" data-medid="{{$medicine->active_record_id}}"></td>
                                                <td>
                                                    <a href="{{ route( 'delete_medication_order', ['id' => $medicine->active_record_id]) }}"
                                                       class="btn btn-danger enable" id="delete" onclick="return Delete()">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                                    </a>
                                                </td>
                                            @else
                                                <td colspan="20"><p>{{$medicine->dosage}}</p></td>
                                                <td>
                                                    <a class="btn btn-danger disabled">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 
                    </div>

                    <div class="row">

                        <!-- Search For labs -->
                        <div class="col-sm-6">

                                <div class="row">
                                    <div class="col-sm-6">
                                    <label for="orders_labs"> Labs:</label>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                    <select id="search_labs_orders" class="js-example-basic-multiple js-states form-control" name="search_labs_orders[]" multiple></select>
                                    </div>
                                </div>

                        </div>
                        <div class="col-sm-6">

                                <div class="row">
                                    <div class="col-sm-6">
                                    <label for="orders_procedure"> Procedure:</label>
                                    </div></div>
                                    <div class="row">
                                        <div class="col-sm-9">
                                    <select id="search_labs_procedure" class="js-example-basic-multiple js-states form-control" name="search_labs_procedure[]" multiple></select>
                                        </div>
                                    </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="bg-info">
                                    <th>List of labs</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($labs as $lab)
                                    <tr>
                                        <td><p>{{$lab->value}}</p></td>
                                        <td>
                                            <a href="{{ route( 'delete_lab_order', ['active_record_id' => $lab->active_record_id]) }}"
                                               class="btn btn-danger enable" id="delete" onclick="return Delete()">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> 
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-sm-6">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                 <tr class="bg-info">
                                    <th>List of procedures</th>
                                    <th>Action</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 @foreach ($procedures as $procedure)
                                    <tr>
                                        <td><p>{{$procedure->value}}</p></td>
                                        <td>
                                            <a href="{{ route( 'delete_procedure_order', ['active_record_id' => $procedure->active_record_id]) }}"
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

                    <div class="row" >
                        <!-- Search For Imaging -->
                        <div class="col-sm-6">

                                <div class="row">
                                    <div class="col-sm-6">
                                    <label for="orders_imaging"> Imaging:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                    <select id="search_labs_imaging" class="js-example-basic-multiple js-states form-control" name="search_labs_imaging[]" multiple></select>
                                    </div>
                                </div>

                        </div>   

                    </div> <br>
                    <div  class="row">
                        <div class="col-sm-6">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="bg-info">
                                    <th>List of Images</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($images as $image)
                                    <tr>
                                        <td><p>{{$image->value}}</p></td>
                                        <td>
                                            <a href="{{ route( 'delete_image_order', ['active_record_id' => $image->active_record_id]) }}"
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

                    <!-- Comment box -->
                    <div class="row">
                        <div class="col-md-12">
                            <label for="Comment"> Comments:</label>
                            <br>
                            @if(!count($comment_order)>0)
                                <textarea rows="4" id="orders_comment" name="orders_comment" style="width: 100%;display: block" ></textarea>
                            @else
                                <textarea rows="4" id="orders_comment" name="orders_comment" style="width: 100%;display: block">{{$comment_order[0]->value}}</textarea>
                            @endif
                        </div>
                    </div>
                <br>


                    {{--Buttons--}}
                    <div class="row">
                        <div class="col-md-6 ">
                            <button type="reset" id="btn_clear_orders_comment" class="btn btn-success" style="float: left">
                                <i class="fa fa-refresh" aria-hidden="true"></i> Reset Orders
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" id="btn_save_orders" class="btn btn-primary" style="float: right">
                                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save Orders
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
        $('#search_labs_orders').select2({
            placeholder: "Choose labs...",
            minimumInputLength: 2,
            ajax: {
                url: '{{route('orders_labs_find')}}',
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

        $('#search_labs_imaging').select2({
            placeholder: "Choose images...",
            minimumInputLength: 2,
            ajax: {
                url: '{{route('orders_imaging_find')}}',
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

        $('#search_labs_procedure').select2({
            placeholder: "Choose procedure...",
            minimumInputLength: 2,
            ajax: {
                url: '{{route('orders_procedure_find')}}',
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
        $('#search_labs_medication').select2({
            placeholder: "Choose medication...",
            minimumInputLength: 2,
            ajax: {
                url: '{{route('orders_medication_find')}}',
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


        $(document).ready(function(){
            var inputsChanged = false;
            $('#orders_form').change(function() {
                inputsChanged = true;
            });

            function unloadPage(){
                if(inputsChanged){
                    return "Do you want to leave this page?. Changes you made may not be saved.";
                }
            }

            $("#btn_save_orders").click(function(){
                inputsChanged = false;
                $('input[name^="Dosage"]').each(function() {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: '{{route('post_medication_dosage')}}',
                        data: { dosage:$(this).val() ,medid:$(this).attr("data-medid")}
                    });
                });

            });
            window.onbeforeunload = unloadPage;

            $('#btn_clear_orders_comment').click( function()
            {
                $('#orders_comment').val('');
                $('#search_labs_imaging').empty().trigger('change');
                $('#search_labs_orders').empty().trigger('change');
                $('#search_labs_procedure').empty().trigger('change');
                $('#search_labs_medication').empty().trigger('change');
                inputsChanged = false;
            } );
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