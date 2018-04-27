@extends('layouts.app')
@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <style>
        .table
        {
            table-layout: fixed;
            word-wrap: break-word;
        }
        table tr th:nth-child(1){
            width: 22%;
        }
        table tr th:nth-child(2){
            width: 10%;
        }
        table tr th:nth-child(3){
            width: 40%;
        }
        table tr th:nth-child(4){
            width: 10%;
        }
        table tr th:nth-child(5){
            width: 10%;
        }

    </style>
    {{--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />--}}



  {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>--}}

    <div class="container" style="width: 88%">
        <div class = "row">
        <div class="col-md-10 col-md-offset-1">
            <div class="row" style="padding-bottom: 20px;">
                <br>
                <div class="col-md-2">
                    <a href="{{url('/home')}}" class="btn btn-success">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Back to Dashboard</a>
                </div>
            </div>
            <br>
            <div class="panel panel-default">
                <div class="panel-heading" style="background: linear-gradient(#af9999,#b3b8bf)">
                    <h4>Add Media</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url("PostMedia")}}">
                        {{ csrf_field() }}
                        @for ($i = 0; $i < $counter ; $i++)
                            <div class="row" id="medialist">
                                <div class="form-group">
                                    <label for="tag" class="col-md-1 control-label" style="padding-right: 0;margin-left: 2px;">Name :</label>
                                    <div class="col-md-3" style="width:22%">
                                        <input id="tag[]" type="tag" class="tag form-control" name="tag[]" autocomplete="off" required>
                                    </div>
                                    <label for="type" class="col-md-1 control-label" style="padding-right: 0;margin-left: 2px;">Type :</label>
                                    <div class="col-md-1" style="width:auto">
                                        <select id="type[]" class="form-control" name="type[]" required>
                                            <option></option>
                                            <option value="Audio"><span class="fa fa-volume-up"></span>Audio</option>
                                            <option value="Video"><span class="fa fa-youtube-play"></span>Video</option>
                                            <option value="Image"><span class="fa fa-image"></span>Image</option>
                                        </select>
                                    </div>
                                    <label for="link" class="col-md-1 control-label" style="padding-right: 0;margin-left: 2px;">Link :</label>
                                    <div class="col-md-3" style="width:31%">
                                        <input id="link[]" type="url" class="form-control" name="link[]" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        @endfor
                        <div style="padding-top: 10px; padding-right: 10px;">
                            <div class="col-md-2" style="float:right">
                                <a href="#" type="button" id="addmedia" style="color: #6f7172;">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add row
                                </a>
                            </div>
                        </div>
                        <div class="form-group" style="padding-top: 20px;">
                            <div align="center">
                                <button type="submit" class="btn btn-primary" id="savemedia">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if($Error == 'Exists')
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @if ($count_exists == '1')
                        Error! Media <strong><i>{{$exists_tag[0]}}&nbsp; -&nbsp;{{$exists_link[0]}} </i></strong> is already present in the database.
                    @elseif ($count_exists > '1')
                        @for($i=0; $i < $count_exists;$i++)
                            Error! Media <strong><i>{{$exists_tag[$i]}}&nbsp; -&nbsp;{{$exists_link[$i]}}</i></strong> &nbsp;&nbsp; already present in the database.
                            <br>
                        @endfor
                    @endif
                </div>
            @endif
            @if($error == 'Does not Exist')
                <div class="alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @if ($count_added == '1')
                        Success!! <strong><i>{{$added_tag[0]}} - {{$added_link[0]}}</i></strong>  media added
                    @elseif ($count_added > '1')
                        @for($i=0; $i < $count_added; $i++)
                            <strong><i>{{$added_tag[$i]}} - {{$added_link[$i]}}</i></strong>&nbsp;&nbsp; media added to the database.
                            <br>
                        @endfor
                    @endif
                </div>
            @endif
        </div>
        </div>
    </div>
    <div class="container" style="width: 88%">
        <div class = "row">

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-stripped table-hover" id="media_table">
                        <thead class="blue-grey lighten-4" >
                        <tr style="font-size: medium;background-color: #fffadd">
                            <th><i aria-hidden="true"></i> Name</th>
                            <th><i aria-hidden="true"></i> Type</th>
                            <th><i aria-hidden="true"></i> Link</th>
                            <th style="border-right: hidden"><i aria-hidden="true"></i> Actions </th>
                        </tr>
                        </thead>
                        <?php $rownum=0; ?>
                        <tbody>
                        @foreach ($media as $mediarow)
                            <?php $rownum=$rownum+1; ?>
                            <tr id="<?php echo $rownum ?>">
                                <td><?php echo($mediarow->media_lookup_value_tag); ?> </td>
                                <td class="<?php echo "selectop".$rownum ?>">
                                    <p class="display"><?php echo($mediarow->media_lookup_value_type); ?></p>
                                </td>
                                <td><a class="linktest" href="<?php echo($mediarow->media_lookup_value_link); ?>" target="_blank"> <?php echo($mediarow->media_lookup_value_link); ?></a></td>
                                <td>
                                    <button class="editButton btn btn-primary" id="<?php echo $rownum ?>"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                    <button class="saveButton btn btn-success" id="<?php echo $rownum ?>" value="{{$mediarow->media_lookup_value_id}}"><i class="fa fa-save" aria-hidden="true"></i></button>
                                    <a href="{{ route('delete_media', ['id' => $mediarow->media_lookup_value_id]) }}" class="btn btn-danger enable" id="delete" onclick="return Delete()">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {

            $('#lasthead').hide();
            $('#media_table').DataTable({
                "pagingType": "full_numbers",
                "paging": true,
                "lengthMenu": [10,25,50,100],
                "columns": [
                    null,
                    null,
                    { "searchable": false },
                    { "searchable": false }
                ],
                "columnDefs": [
                    { orderable: false, targets: 3 }
                ],
                "dom": 'l<"toolbar">frtip',
                "createdRow": function( row, data, dataIndex ) {
                    var saveelems = $(row).find('.saveButton');
                    for (var i = 0; i < saveelems.length; i++){
                        saveelems[i].style.display='none';
                    }
                    var selected = $(row).find('.display').text();
                    if(selected == "Audio") {
                        var htmlData = '<select id="optionselect form-control" class="optionselect" required><option value="Audio" selected>Audio</option><option value="Video">Video</option><option value="Image">Image</option></select>';
                    }else if(selected == "Video") {
                        var htmlData = '<select id="optionselect form-control" class="optionselect" required><option value="Audio">Audio</option><option value="Video" selected>Video</option><option value="Image">Image</option></select>';
                    }else{
                        var htmlData = '<select id="optionselect form-control" class="optionselect" required><option value="Audio">Audio</option><option value="Video">Video</option><option value="Image" selected>Image</option></select>';
                    }
                    var type;
                    $(row).find(".editButton").click(function(){
                        var id=$(row).attr("id");
                        console.log(id);
                        var idn=".selectop"+id;
                        $(row).find("td:nth-child(1)").css({'border-top' : '2px #5DADE2 solid'});
                        $(row).find("td:nth-child(1)").css({'border-bottom' : '2px #5DADE2 solid'});
                        $(row).find("td:nth-child(1)").css({'border-left' : '2px #5DADE2 solid'});
                        $(row).find("td:nth-child(2)").css({'border-top' : '2px #5DADE2 solid'});
                        $(row).find("td:nth-child(2)").css({'border-bottom' : '2px #5DADE2 solid'});
                        $(row).find("td:nth-child(3)").css({'border-top' : '2px #5DADE2 solid'});
                        $(row).find("td:nth-child(3)").css({'border-bottom' : '2px #5DADE2 solid'});
                        $(row).find("td:nth-child(3)").css({'border-right' : '2px #5DADE2 solid'});
                        $(row).find(idn).append(htmlData);

                        $(row).find('.editButton').css('display','none');
                        $(row).find('.saveButton').css('display','inline-block');
                        $(row).find('.display').css('display','none');
                        $(row).find("td:nth-child(1)").prop("contentEditable",true);
                        $(row).find("td:nth-child(2)").prop("contentEditable",true);
                       // $(row).find("td:nth-child(3)").prop("contentEditable",true);
                        $(row).find(".linktest").prop("contentEditable",true);


                    });
                    $(row).find(".saveButton").click(function(){
                        var id=$(row).attr("id");
                        var idn=".selectop"+id;
                        var value=$(row).find(".saveButton").attr('value');
                        var arr = new Array();
                        type = $(row).find('.optionselect').val();
                        if(type!='Audio' && type!='Video' && type!='Image' ){
                            alert("Please Select Type");
                        }else{
                            $(row).find("td:nth-child(1)").css({'border-top' : ''});
                            $(row).find("td:nth-child(1)").css({'border-bottom' : ''});
                            $(row).find("td:nth-child(1)").css({'border-left' : ''});
                            $(row).find("td:nth-child(2)").css({'border-top' : ''});
                            $(row).find("td:nth-child(2)").css({'border-bottom' : ''});
                            $(row).find("td:nth-child(3)").css({'border-top' : ''});
                            $(row).find("td:nth-child(3)").css({'border-bottom' : ''});
                            $(row).find("td:nth-child(3)").css({'border-right' : ''});
                            $(row).find('.editButton').css('display','inline-block');
                            $(row).find('.saveButton').css('display','none');
                            $(row).find('.optionselect').css('display','none');
                            $(row).find('.optionselect').remove();
                            $(row).find('.display').css('display','inline-block');
                            $(row).find('.display').text(type);
                            $(row).find("td:nth-child(1)").prop("contentEditable",false);
                            $(row).find("td:nth-child(2)").prop("contentEditable",false);
                            $(row).find("td:nth-child(3)").prop("contentEditable",false);
                            $(row).find(".linktest").prop("contentEditable",false);


                            arr.push($(row).find("td:nth-child(1)").html());
                            arr.push(type);
                           // alert($(row).find(".linktest").html())
                            arr.push($(row).find(".linktest").html());
                            arr.push(value);

                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: "post",
                                url: '{{route('post_new_media')}}',
                                data: { name:arr[0] ,link:arr[2], type:arr[1], id:arr[3]}


                            });

                            $(row).find('.linktest').prop("href",arr[2]);

                            var mytable = $('#media_table').DataTable();
                            mytable.search('').draw();
                            mytable.columns.adjust().draw();

                        }
                    });

                }

            });

            $("div.toolbar").html('<button id="clearsearch" autocomplete="off" class="close" type="button"><i class="fa fa-close" style="font-size: 18px;padding-top: 8px; color: red;"></i></button>');
            var medtable = $('#media_table').DataTable();
            $("#clearsearch").click(function(event){
                medtable.search('').draw();
            });

            $(".alert").fadeOut(5000);
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $("#medialist"); //Fields wrapper
            var add_button      = $("#addmedia"); //Add button ID
            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if (x >= max_fields) {
                } else { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="row" style="padding-top: 20px;margin-left: 0px;"><div class="form-group"><label for="tag" class="col-md-1 control-label" style="padding-right: 0">Name :</label> <div class="col-md-3" style="width:22%"> <input id="tag[]" type="tag" class="tag form-control" name="tag[]" autocomplete="off" required></div><label for="type" class="col-md-1 control-label" style="padding-right: 0;">Type :</label><div class="col-md-1" style="width:auto"><select id="type[]" class="tag form-control" name="type[]" required><option></option><option>Audio</option><option>Video</option><option>Image</option></select></div><label for="link" class="col-md-1 control-label" style="padding-right: 0;">Link :</label><div class="col-md-3" style="width:31%"><input id="link[]" type="url" class="form-control" name="link[]" autocomplete="off" required></div><div class="col-md-1" style="width:auto"><a href="#" class="remove_field"><i class="fa fa-close" style="font-size: 18px;padding-top: 8px; color: red;"></i></a></div> </div></div>');
                }

            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent().parent().parent('div').remove(); x--;
            });

            var inputsChanged = false;
            $('#medias_form').change(function() {
                inputsChanged = true;
            });


            $("#savemedia").click(function() {
                var len = $(".tag").length;
                //var elements= new array();
                var elements = document.getElementsByClassName("tag");
                var a = new Array();
                for (var i = 0; i < len; i++) {
                    a[i] = elements[i].value;
                }
                for (var i = 0; i <= a.length; i++) {
                    if(a[i]!=""){
                        if (!a[i].replace(/\s/g, '').length) {
                            alert("Input cannot contain only white spaces");
                        }
                    }
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