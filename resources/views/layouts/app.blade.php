<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WeChart</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>

        #navigation_bar li a:hover{
            background-color: #ffffff;
        }

        #navigation_bar li.active  a {
            background-color: #ffffff;
        }



        .side-menu-wrapper { /* style menu wrapper */
            overflow: hidden;
            background: #5DADE2;
            padding: 40px 0 0 20px;
            position: fixed; /* Fixed position */
            top: 0;
            right: -290px; /* Sidebar initial position. "right" for right positioned menu */
            height: 100%;
            z-index: 2;
            transition: 0.5s; /* CSS transition speed */
            width: 200px;
            font: 30px;
            font-style: bold;
            opacity: 0.8;
        }
        .side-menu-wrapper > ul{ /* css ul list style */
            list-style:none;
            padding:0;
            margin:0;
            overflow-y: auto; /* enable scroll for menu items */
            width:500px; /* this width will hide scroll bar */
            height:95%;
        }
        .side-menu-wrapper > ul > li > a { /* links */
            display: block;
            border-bottom: ;
            padding: 6px 4px 6px 4px;
            color: #000000;
            transition: 0.3s;
            text-decoration: none;
            font: 30px;
            font-style: bold;

        }
        .side-menu-wrapper > a.menu-close { /* close button */
            padding: 8px 0 4px 23px;
            color: #000000;
            display:block;
            margin: -30px 0 -10px -20px;
            font-size: 20px;
            text-decoration: none;
        }

        .side-menu-overlay { /* overlay */
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgba(0,0,0,.7);
            overflow-y: auto;
            overflow-x: hidden;
            text-align: center;
            opacity: 0.5;
            transition: opacity 1s;
        }

        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 12px;
            border: none;
            outline: none;
            background-color: #5DADE2;
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }

    </style>
</head>
<body>
<div id="app">
    @guest

    @else

        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #5DADE2;" id="navigation_bar">
            <div class="container-fluid">
                <div class="navbar-header">

                    @if(Auth::user()->role == 'Student')

                        <a class="navbar-brand" href="/StudentHome">
                            <img src="{{ URL::asset('logos/WeChart.png') }}" height="150%">
                        </a>

                    @elseif(Auth::user()->role == 'Instructor')

                        <a class="navbar-brand" href="/InstructorHome">
                            <img src="{{ URL::asset('logos/WeChart.png') }}" height="150%">
                        </a>

                    @else
                        <a class="navbar-brand" href="/home">
                            <img src="{{ URL::asset('logos/WeChart.png') }}" height="150%">
                        </a>
                    @endif

                </div>

                <div >
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li> <a id="role" style="color: darkblue"> <b>Role: {{ Auth::user()->role}}</b></a></li>
                        <li>
                            <a href="#" class="slide-menu-open" style="color: darkblue"><b>{{ Auth::user()->firstname }} &nbsp;{{ Auth::user()->lastname}} &nbsp;</b><i class="fa fa-arrow-left"></i></a>
                            <div class="side-menu-overlay" style="width: 0px; opacity: 0;"></div>
                            <div class="side-menu-wrapper">
                                <a href="#" class="menu-close"><i class="fa fa-arrow-right"></i></a>
                                <br>
                                <ul>
                                    <li>
                                        <a href="{{ URL::route('EditProfile', Auth::user()->id) }}">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            Edit Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        @endguest
        <div class="edokati">
            <br>
            <br>
            <br>
            @yield('content')
            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
        </div>
</div>

<!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>




<script type="text/javascript">
    var slidebar_width  = 290; //slidebar width + padding size
    var slide_bar       = $(".side-menu-wrapper"); //slidebar
    var slide_open_btn  = $(".slide-menu-open"); //slidebar close btn
    var slide_close_btn = $(".menu-close"); //slidebar close btn
    var overlay         = $(".side-menu-overlay"); //slidebar close btn

    slide_open_btn.click(function(e){
        e.preventDefault();
        slide_bar.css( {"right": "0px"}); //change to "right" for right positioned menu
        overlay.css({"opacity":"1", "width":"100%"});

        $(".side-menu-overlay").click(function(){

            e.preventDefault();
            slide_bar.css({"right": "-"+ slidebar_width + "px"}); //change to "right" for right positioned menu
            overlay.css({"opacity":"0", "width":"0"});

        });

    });
    slide_close_btn.click(function(e){
        e.preventDefault();
        slide_bar.css({"right": "-"+ slidebar_width + "px"}); //change to "right" for right positioned menu
        overlay.css({"opacity":"0", "width":"0"});
    });

    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 10 || document.documentElement.scrollTop > 10) {
            document.getElementById("myBtn").style.display = "block";
        }
        else {
            document.getElementById("myBtn").style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }


</script>
</body>
</html>