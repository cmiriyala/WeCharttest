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
        width: 55%;
    }


</style>
@extends('layouts.app')
@section('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <select value="B">
        <option value="A">Apple</option>
        <option value="B">Banana</option>
        <option value="C">Cranberry</option>
    </select>
    <div class="container" style="width: 85%">
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
                <div class="panel-heading" style="background-color: lightblue">
                    <h4>Add Media</h4>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{url("PostMedia")}}">
                        {{ csrf_field() }}
                        @for ($i = 0; $i < $counter ; $i++)
                            <div class="row" id="medialist">
                                <div class="form-group">
                                    <label for="tag" class="col-md-1 control-label" style="padding-right: 0;margin-left: 2px;">Name :</label>
                                    <div class="col-md-3">
                                        <input id="tag[]" type="tag" class="tag form-control" name="tag[]" autocomplete="off" required>
                                    </div>
                                    <label for="type" class="col-md-1 control-label" style="padding-right: 0;margin-left: 2px;">Type :</label>
                                    <div class="col-md-2" style="width:12%">
                                        <select id="type[]" class="form-control" name="type[]" required>
                                            <option></option>
                                            <option value="Audio"><span class="fa fa-volume-up"></span>Audio</option>
                                            <option value="Video"><span class="fa fa-youtube-play"></span>Video</option>
                                            <option value="Image"><span class="fa fa-image"></span>Image</option>
                                        </select>
                                    </div>
                                    <label for="link" class="col-md-1 control-label" style="padding-right: 0;margin-left: 3px;">Link :</label>
                                    <div class="col-md-6" style="width:28%">
                                        <input id="link[]" type="url" class="form-control" name="link[]" autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                        @endfor
                        <div style="padding-top: 10px; padding-right: 10px;">
                            <div class="col-md-2" style="float:right">
                                <a href="#" type="button" id="addmedia" style="color: #3097D1;">
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
    <div class="container" style="width: 85%">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-body">

                <div class="navbar-right">
                    <div class="row">
                        <div class="col-md-10"><input id="search_media" type="text" class="form-control" name="search" placeholder="Search Media..."></div>
                        <div class="col-md-1"><button id="clearsearch" autocomplete="off" class="close" type="button"><i class="fa fa-close" style="font-size:22px;color:#DD0000"></i></button></div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row"> <div class="col-md-3"></div><div class="col-md-6"><div id="myaudio"></div></div><div class="col-md-3"></div></div>

            </div>

            <div class="panel panel-default" style="margin-bottom: 0;padding-bottom: 0">
                <div class="panel-body">
                    <table class="table table-bordered table-stripped table-hover" id="media_table">
                        <thead class="blue-grey lighten-4">
                        <tr style="font-size: medium;background-color: #e0f2f1">
                            <th><i aria-hidden="true"></i> Name</th>
                            <th><i aria-hidden="true"></i> Type</th>
                            <th><i aria-hidden="true"></i> Link</th>
                            <th colspan="3"> Actions </th>
                        </tr>
                        </thead>
                        <?php $rownum=0; ?>
                        <tbody id="tmediabody">
                        @foreach ($media as $mediarow)
                            <?php $rownum=$rownum+1; ?>
                            <tr>
                                <td><?php echo($mediarow->media_lookup_value_tag); ?> </td>
                                <td class ="selectop"><select id="optionselect" class="optionselect" required><option></option>
                                        <option value="Audio">Audio</option>
                                        <option value="Video">Video</option>
                                        <option value="Image">Image</option>
                                    </select>
                                    <p class="display"><?php echo($mediarow->media_lookup_value_type); ?></p>
                                </td>
                                <td><?php echo($mediarow->media_lookup_value_link); ?></td>
                                <td><a href = "<?php echo($mediarow->media_lookup_value_link); ?>" target="_blank"  class="btn btn-default" id="audlink<?php echo $rownum ?>" ><i class="fa fa-link" aria-hidden="true" style="color:#A569BD"></i></a></td>
                                <td>
                                    <button class="editButton btn btn-info" id="<?php echo $rownum ?>"><i class="fa fa-edit" aria-hidden="true"></i></button>
                                    <button class="saveButton btn btn-success" id="<?php echo $rownum ?>" value="{{$mediarow->media_lookup_value_id}}"><i class="fa fa-save" aria-hidden="true"></i></button>
                                </td>
                                <td>
                                    <a href="{{ route('delete_media', ['id' => $mediarow->media_lookup_value_id]) }}" class="btn btn-danger enable" id="delete" onclick="return Delete()">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $media->links() }}

                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function () {

            cssProp();
            function cssProp() {
                var saveelems = document.getElementsByClassName('saveButton');

                for (var i = 0; i < saveelems.length; i++){
                    saveelems[i].style.display='none';
                }

                var optionselect = document.getElementsByClassName('optionselect');

                for (var i = 0; i < optionselect.length; i++){
                    optionselect[i].style.display='none';
                }

            }

            $('#search_media').on('keyup',function(){
                $value=$(this).val();
                $.ajax({
                    type : 'get',
                    url : '{{url("SearchMedia")}}',
                    data:{'search':$value},
                    success:function(data){
                        $('#tmediabody').html(data);
                        cssProp();
                        $(".editButton").click(function(){
                            var id = $(this).attr('id');
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-top' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-bottom' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-left' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(2)").css({'border-top' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(2)").css({'border-bottom' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-top' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-bottom' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-right' : '2px #5DADE2 solid'});


                            //border-collapse: collapse;
                            edit(id);
                        });
                        $(".saveButton").click(function(){
                            var id = $(this).attr('id');
                            var value=$(this).attr('value');
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-top' : ''});
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-bottom' : ''});
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-left' : ''});
                            $(this).closest("tr").find("td:nth-child(2)").css({'border-top' : ''});
                            $(this).closest("tr").find("td:nth-child(2)").css({'border-bottom' : ''});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-top' : ''});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-bottom' : ''});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-right' : ''});
                            save(id,value);
                        });
                    }
                });
            });

            $("#clearsearch").click(function(event){

                $('#search_media').val('');
                $.ajax({
                    type : 'get',
                    url : '{{url("SearchMedia")}}',
                    data:{'search':""},
                    success:function(data){
                        $('#tmediabody').html(data);
                        cssProp();
                        $(".editButton").click(function(){
                            var id = $(this).attr('id');
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-top' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-bottom' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-left' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(2)").css({'border-top' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(2)").css({'border-bottom' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-top' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-bottom' : '2px #5DADE2 solid'});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-right' : '2px #5DADE2 solid'});
                            edit(id);

                        });
                        $(".saveButton").click(function(){
                            var id = $(this).attr('id');
                            var value=$(this).attr('value');
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-top' : ''});
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-bottom' : ''});
                            $(this).closest("tr").find("td:nth-child(1)").css({'border-left' : ''});
                            $(this).closest("tr").find("td:nth-child(2)").css({'border-top' : ''});
                            $(this).closest("tr").find("td:nth-child(2)").css({'border-bottom' : ''});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-top' : ''});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-bottom' : ''});
                            $(this).closest("tr").find("td:nth-child(3)").css({'border-right' : ''});
                            save(id,value);
                        });
                    }
                });
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
                    $(wrapper).append('<div class="row" style="padding-top: 20px;margin-left: 0px;"><div class="form-group"><label for="tag" class="col-md-1 control-label" style="padding-right: 0">Name :</label> <div class="col-md-3"> <input id="tag[]" type="tag" class="tag form-control" name="tag[]" autocomplete="off" required></div><label for="type" class="col-md-1 control-label" style="padding-right: 0;margin-left: 2px;">Type :</label><div class="col-md-2" style="width:12%"><select id="type[]" class="tag form-control" name="type[]" required><option></option><option>Audio</option><option>Video</option><option>Image</option></select></div><label for="link" class="col-md-1 control-label" style="padding-right: 0;margin-left: 3px;">Link :</label><div class="col-md-3" style="width:28%"><input id="link[]" type="url" class="form-control" name="link[]" autocomplete="off" required></div><div class="col-md-1"><a href="#" class="remove_field"><i class="fa fa-close" style="font-size: 18px;padding-top: 8px; color: red;"></i></a></div> </div></div>');
                }

            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent().parent('div').remove(); x--;
            });

            var inputsChanged = false;
            $('#medias_form').change(function() {
                inputsChanged = true;
            });
            function edit(id) {
                var id_class = id-1;

                document.getElementsByClassName('editButton')[id_class].style.display='none';
                document.getElementsByClassName('saveButton')[id_class].style.display='inline-block';
                document.getElementsByClassName('optionselect')[id_class].style.display='inline-block';
                document.getElementsByClassName('display')[id_class].style.display='none';

                document.getElementById("media_table").rows[id].cells[0].contentEditable='true';
                document.getElementById("media_table").rows[id].cells[1].contentEditable='true';
                document.getElementById("media_table").rows[id].cells[2].contentEditable='true';
            }

            $(".editButton").click(function(){
                var id = $(this).attr('id');
                $(this).closest("tr").find("td:nth-child(1)").css({'border-top' : '2px #5DADE2 solid'});
                $(this).closest("tr").find("td:nth-child(1)").css({'border-bottom' : '2px #5DADE2 solid'});
                $(this).closest("tr").find("td:nth-child(1)").css({'border-left' : '2px #5DADE2 solid'});
                $(this).closest("tr").find("td:nth-child(2)").css({'border-top' : '2px #5DADE2 solid'});
                $(this).closest("tr").find("td:nth-child(2)").css({'border-bottom' : '2px #5DADE2 solid'});
                $(this).closest("tr").find("td:nth-child(3)").css({'border-top' : '2px #5DADE2 solid'});
                $(this).closest("tr").find("td:nth-child(3)").css({'border-bottom' : '2px #5DADE2 solid'});
                $(this).closest("tr").find("td:nth-child(3)").css({'border-right' : '2px #5DADE2 solid'});
                edit(id);

            });
            function save(id,value) {
                var id_class = id-1;
                var arr = new Array();
                var type=document.getElementsByClassName('optionselect')[id_class].value;
                if(type!='Audio' && type!='Video' && type!='Image' ){
                    alert("Please select type")
                }else{
                    document.getElementsByClassName('editButton')[id_class].style.display='inline-block';
                    document.getElementsByClassName('saveButton')[id_class].style.display='none';
                    document.getElementsByClassName('optionselect')[id_class].style.display='none';
                    document.getElementsByClassName('display')[id_class].style.display='inline-block';
                    document.getElementsByClassName('display')[id_class].innerHTML=type;
                    document.getElementById("media_table").rows[id].cells[0].contentEditable='false';
                    document.getElementById("media_table").rows[id].cells[1].contentEditable='false';
                    document.getElementById("media_table").rows[id].cells[2].contentEditable='false';
                    arr.push(document.getElementById("media_table").rows[id].cells[0].innerHTML);
                    //arr.push(type);
                    arr.push(document.getElementById("media_table").rows[id].cells[2].innerHTML);
                    arr.push(value);
                    //alert(arr[1]);
                    //alert(document.getElementById("media_table").rows[id].cells[1].innerHTML);


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: '{{route('post_new_media')}}',
                        data: { name:arr[0] ,link:arr[2], type:arr[1], id:arr[3]}


                    });
                    var audli = '#audlink'+id;
                    $(audli).attr("href",arr[2])

                }
            }

            $(".saveButton").click(function(){
                var id = $(this).attr('id');
                var value=$(this).attr('value');
                $(this).closest("tr").find("td:nth-child(1)").css({'border-top' : ''});
                $(this).closest("tr").find("td:nth-child(1)").css({'border-bottom' : ''});
                $(this).closest("tr").find("td:nth-child(1)").css({'border-left' : ''});
                $(this).closest("tr").find("td:nth-child(2)").css({'border-top' : ''});
                $(this).closest("tr").find("td:nth-child(2)").css({'border-bottom' : ''});
                $(this).closest("tr").find("td:nth-child(3)").css({'border-top' : ''});
                $(this).closest("tr").find("td:nth-child(3)").css({'border-bottom' : ''});
                $(this).closest("tr").find("td:nth-child(3)").css({'border-right' : ''});
                save(id,value);
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