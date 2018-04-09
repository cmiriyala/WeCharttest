@extends('layouts.app')

@section('content')
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row col-md-8">
                    <a href="{{url('/home')}}" class="btn btn-success" style="float: left">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Back to Dashboard</a>
                </div>
                <br><br>
                <div class="panel panel-default">
                    <div class="panel-heading" style="backgroundd-color: lightblue">
                        <h4>Add Student Email Address</h4>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ url('AddStudentEmails') }}">
                            {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Enter E-Mail Address:</label>

                                    <div class="col-md-6" id="emaillist">
                                        <div class="row"><div class="col-md-11"><input id="email[]" type="email" class="test form-control" name="email[]" required></div></div>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>



                            <div class="col-md-4" style="float:right">
                                <a href="#" type="button" id="addemail">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add row
                                </a>
                            </div>
                            <br>
                            <br>

                            <div class="form-group">
                                <div id="sendData" class="col-md-6 col-md-offset-4">
                                    <button id="saveD" type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- After user submits request -->
                {{--If Unique contraint violation--}}
                @if($ErrorPresent == 'Email Present')
                    @foreach($mailpre as $mailpresent)
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                            Error! email address {{$mailpresent['emailpresent']}}is already present in the database.
                    </div>
                    @endforeach
                @elseif($ErrorPresent == 'Instructor Present')
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                        Error! The email already present in database.
                    </div>
                @endif


                {{--if successfully submitted--}}
                @if($Error == 'No')
                @foreach($mailsaved as $mailsave)
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

                            Success! email address {{$mailsave['emailsaved']}}  is saved in the database.


                    </div>
                @endforeach
                @endif
            </div>
        </div>
        <script>

            $(document).ready(function() {
                $(".alert").fadeOut(10000);
                var max_fields      = 10; //maximum input boxes allowed
                var wrapper         = $("#emaillist"); //Fields wrapper
                var add_button      = $("#addemail"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="row"><br><div class="col-md-11"><input class="test form-control" type="email" name="email[]" id="email[]" required></div><div class="col-md-1" ><a href="#" class="remove_field"><i class="fa fa-close" style="font-size:25px; color: #DD0000"></i></a></div></div>'); //add input box
                    }
                });

                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).parent().parent('div').remove(); x--;
                })

                $("#saveD").click(function(){
                    var len = $(".test").length;
                    //var elements= new array();
                    var elements = document.getElementsByClassName("test");
                    console.log(elements);
                    var a = new Array();
                    for(var i=0; i<len; i++) {
                        a[i]= elements[i].value;
                    }
                    for(var i=0; i<len; i++) {
                        console.log(a[i]);
                    }
                    console.log(a);
                    for(var i = 0; i <= a.length; i++) {
                        for(var j = i; j <= a.length; j++) {
                            if(i != j && a[i] == a[j]) {
                                if(a[i]=='')
                                {
                                    alert("Data is empty");
                                    break;
                                }
                                else {
                                alert(a[i]+" is duplicated");
                                return false;
                                }
                            }
                        }
                    }


                });
            });
        </script>
@endsection