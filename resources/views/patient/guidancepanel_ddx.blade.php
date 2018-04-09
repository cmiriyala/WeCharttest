<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <style>
        table tr{
            cursor: move;
        }
    </style>
</head>
<body>

<form class="form-horizontal" method="POST" action="{{ route('post_ddx') }}" id="ddx_form">
    {{ csrf_field() }}
    <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
    <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
    <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
    <div class="row">
        <div class="col-md-2">
            <label for="Diagnosis"> Diagnosis:</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11">
            <select id="search_diagnosis_ddx" style="width: 405px" class="form-control" name="search_diagnosis_ddx[]" multiple></select>
        </div>
        <br><br>
        <div class="col-md-11"> <sup><i class="fa fa-asterisk" style="font-size:9px"></i></sup> This is a priority based list with the top most item being the highest priority</div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped table-bordered table-hover" id="ddxtable">
                <thead>
                <tr class="bg-info">
                    <th>List of Diagnosis</th>
                    <th>Comments</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($diagnosis_list_ddx as $diagnosis)
                    <tr id="<?php echo $diagnosis->active_record_id; ?>">
                        <td><p><?php echo ($diagnosis->value); ?></p></td>
                        @if($diagnosis->comments==null)
                            <td><input type="text" id="Comments" name="Comments[]" data-diagnosisid="{{$diagnosis->active_record_id}}"></td>
                        @else
                            <td><textarea type="text" id="Textcom" name="Textcom[]" data-diagnosisid="{{$diagnosis->active_record_id}}">{{$diagnosis->comments}}</textarea></td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6" style="padding-right: 25px">
            <button type="submit" id="btn_save_ddx" class="btn btn-primary"  style="float: right">
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Save DDx
            </button>
        </div>
    </div>
</form>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

<script type="text/javascript">
    var $sortable=$("#ddxtable > tbody");
    $sortable.sortable({
        start: function(event, ui) {
            // change css here
            ui.item.css('background-color', '#83C5E3');
        },
        stop:function(event,ui){
            ui.item.css('background-color', '');
            var parameters = $sortable.sortable("toArray");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: '{{route('post_ddx_sorted')}}',
                data: { parameters: parameters }
            });
        }
    });
    $('#search_diagnosis_ddx').select2({
        minimumInputLength: 2,
        placeholder:"Choose...",
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
        $('.filter-modal select').css('width', '100%');
        var inputsChanged = false;
        $('#ddx_form').change(function() {
            inputsChanged = true;
        });

        function unloadPage(){
            if(inputsChanged){
                return "Do you want to leave this page?. Changes you made may not be saved.";
            }
        }

        $("#btn_save_ddx").click(function(){
            inputsChanged = false;
            $('input[name^="Comments"]').each(function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: '{{route('post_guidance_comments')}}',
                    data: { comments:$(this).val() ,diagnosisid:$(this).attr("data-diagnosisid")}
                });
            });
            $('textarea[name^="Textcom"]').each(function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: '{{route('update_guidance_comments')}}',
                    data: { comments:$(this).val() ,diagnosisid:$(this).attr("data-diagnosisid")}
                });
            });

        });
        window.onbeforeunload = unloadPage;
    });
</script>
</body>
</html>