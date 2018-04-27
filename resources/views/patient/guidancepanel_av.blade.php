<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <style>
        .glyphicon.glyphicon-remove {
            font-size: 25px;
        }
    </style>
</head>

<body><br>
<div class="content">

    <div class="form-group">
        <div class="row ">
            <div class="col-md-5  pull-right">
                <button id="mybutton" class="btn btn-primary" ><span class="glyphicon glyphicon-remove"style="font-size:15px"></span> Clear All</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <label> Audio: </label>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-8">
                <select class="form-control" id="searchaudio" onchange='Checkaudio(this.value);'>
                    <option value=""></option>
                    @foreach($audios as $audio)
                        <option value="<?php echo $audio['media_lookup_value_link'];?>"><?php echo $audio['media_lookup_value_tag'];?></option>
                    @endforeach
                    <option value="1"></option>
                </select>
            </div>
            <div class="col-sm-3"><a id="closeaudio" ><span class="glyphicon glyphicon-remove" style="font-size:18px; color:#ad122a"></span></a></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div id="myaudio"></div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
    <div class="form-group">
        <div class="row"><div class="col-sm-1"></div><label> Video: </label></div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-8">
                <select class="form-control" id="search" onchange='Checkfunc(this.value);'>
                    <option value=""></option>
                    @foreach($videos as $video)
                        <option value="<?php echo $video['media_lookup_value_link'];?>"><?php echo $video['media_lookup_value_tag'];?></option>
                    @endforeach
                    <option value="1"></option>
                </select>
            </div>
            <div class="col-sm-3"><a id="closevideo" ><span class="glyphicon glyphicon-remove" style="font-size:18px; color:#ad122a"></span></a></div>

        </div>
        <br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div id="myvideo"></div>
            </div>
            <div class="col-sm-1"></div>
        </div>

    </div>
    <div class="form-group">
        <div class="row"><div class="col-sm-1"></div><label> Picture: </label></div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-8">
                <select class="form-control" id="searchpic" onchange='CheckPicture(this.value);'>
                    <option value=""></option>
                    @foreach($pictures as $picture)
                        <option value="<?php echo $picture['media_lookup_value_link'];?>"><?php echo $picture['media_lookup_value_tag'];?></option>
                    @endforeach
                    <option value="1"></option>
                </select>
            </div>
            <div class="col-sm-3"><a id="closepictures" ><span class="glyphicon glyphicon-remove" style="font-size:18px"></span></a></div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <div id="mypicture"></div>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        inputchangepicture = false;
        inputchangevideo = false;
        inputchangeaudio = false;
        $('#closeaudio').hide();
        $('#closevideo').hide();
        $('#closepictures').hide();
    })
    function Checkfunc(val){
        $('#closevideo').show();
        if(val=='')
        {
            return 'false';
        }
        else
        {
            var myId = getId(val);
            $('#myvideo').addClass('embed-responsive embed-responsive-16by9')
            document.getElementById('myvideo').innerHTML+='<iframe class="embed-responsive-item" width="380" height="225" allowfullscreen="1" src="//www.youtube.com/embed/' + myId + '" allowfullscreen></iframe>';
            function getId(url)
            {
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                var match = url.match(regExp);
                if (match && match[2].length == 11)
                {
                    return match[2];
                }
                else
                {
                    return 'error';
                }
            }
        }
    }
    $('#search').select2({
        placeholder: 'Select a video..',
        width:'100%'
    });
    function Checkaudio(val){
        $('#closeaudio').show();
        if(val=='')
        {
            return 'false';
        }
        else
        {
            var myId = getId(val);
            $('#myaudio').addClass('embed-responsive embed-responsive-16by9')
            document.getElementById('myaudio').innerHTML+='<iframe class="embed-responsive-item" width="380" height="225" allowfullscreen="true" src="//www.youtube.com/embed/' + myId + '" allowfullscreen></iframe>';
            function getId(url)
            {
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                var match = url.match(regExp);
                if (match && match[2].length == 11)
                {
                    return match[2];
                }
                else
                {
                    return 'error';
                }
            }
        }
    }
    $('#searchaudio').select2({
        placeholder: 'Select an audio..',
        width:'100%'
    });
    function CheckPicture(val)
    {
        $('#closepictures').show();
        if(val=='')
        {
            return 'false';
        }
        else
        {
            $('#mypicture').addClass('embed-responsive embed-responsive-16by9')
            document.getElementById('mypicture').innerHTML+='<img id="image" class="embed-responsive-item" width="380" height="225" style="background-color:#EDF1F2;" src='+ val +'>';
        }
    }
    $('#searchpic').select2({
        placeholder: 'Select a picture..',
        width:'100%',
    });
    $('#mybutton').click(function () {
        inputchangepicture = false;
        inputchangevideo = false;
        inputchangeaudio = false;
        $('#searchpic').val('1').change();
        $('#mypicture').hide();
        $('#closepictures').hide();
        clearPic();
        $('#search').val('1').change();
        $('#myvideo').hide();
        $('#closevideo').hide();
        clearVid();
        $('#searchaudio').val('1').change();
        $('#myaudio').hide();
        $('#closeaudio').hide();
        clearAuid();
    });
    $('#closepictures').click(function () {
        $('#searchpic').val('1').change();
        $('#mypicture').hide();
        $('#closepictures').hide();
        inputchangepicture = false;
        clearPic();
    });
    function clearPic()
    {
        var x = document.getElementById("searchpic");
        var len= x.length;
        var txt = new Array();
        var val = new Array();
        var i;
        for (i = 0; i < x.length; i++) {
            txt[i] = x.options[i].text ;
            val[i] = x.options[i].value;
        }
        $("#searchpic").empty();
        for (i = 0; i < len; i++) {
            $('#searchpic').append($('<option>', {
                value: val[i],
                text: txt[i]
            }));
        }
    }


    $('#closevideo').click(function () {
        $('#search').val('1').change();
        $('#myvideo').hide();
        $('#closevideo').hide();
        inputchangevideo = false;
        clearVid();
    });
    function clearVid()
    {
        var x = document.getElementById("search");
        var len= x.length;
        var txt = new Array();
        var val = new Array();
        var i;
        for (i = 0; i < x.length; i++) {
            txt[i] = x.options[i].text ;
            val[i] = x.options[i].value;
        }
        $("#search").empty();
        for (i = 0; i < len; i++) {
            $('#search').append($('<option>', {
                value: val[i],
                text: txt[i]
            }));
        }
    }
    $('#closeaudio').click(function () {
        inputchangeaudio = false;
        $('#searchaudio').val('1').change();
        $('#myaudio').hide();
        $('#closeaudio').hide();
        clearAuid();
    });
    function clearAuid(){
        var x = document.getElementById("searchaudio");
        var len= x.length;
        var txt = new Array();
        var val = new Array();
        var i;
        for (i = 0; i < x.length; i++) {
            txt[i] = x.options[i].text ;
            val[i] = x.options[i].value;
        }
        $("#searchaudio").empty();
        for (i = 0; i < len; i++) {
            $('#searchaudio').append($('<option>', {
                value: val[i],
                text: txt[i]
            }));
        }
    }
    $('#searchpic').change(function () {
        $('#mypicture').show();
        inputchangepicture = true;
    });
    $('#searchaudio').change(function () {
        $('#myaudio').show();
        inputchangeaudio = true;
    });
    $('#search').change(function () {
        $('#myvideo').show();
        inputchangevideo = true;
    });
</script>


</body>
</html>