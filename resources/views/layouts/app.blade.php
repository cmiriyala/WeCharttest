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

        .footr a{
            font-family: Montserrat, sans-serif;
            font-weight: bold;
            font-size: 15px;
            text-decoration: none;
            color:white;
        }
        .navbar{
            -webkit-box-shadow: 0 8px 6px -6px #999;
            -moz-box-shadow: 0 8px 6px -6px #999;
            box-shadow:-5px -2px 50px 5px black;
            border: 0;
        }
        .dropdown-toggle a {
            background-color: #000000;
            color: #000000;
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
            background: linear-gradient(#04A2C9,#075DBF);
            color: white;
            cursor: pointer;
            padding: 15px;
            border-radius: 4px;
        }
        #mask {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 10;
            width: 100%;
            height: 100%;
            opacity: 0.8;
            z-index: 999;
        }

        /* You can customize to your needs  */
        .popup {
            display: none;
            background: rgba(93, 173, 226, 1);
            padding: 10px;
            color: white;
            font-weight: bold;
            border: 2px solid #ddd;
            font-size: 1.2em;
            position: fixed;
            top: 20%;
            left: 20%;
            right: 20%;
            z-index: 99999;
            box-shadow: 10px 10px 20000px 10px #FFFFFF;
            /* CSS3 */
            -moz-box-shadow: 10px 10px 20000px 10px #FFFFFF;
            /* Firefox */
            -webkit-box-shadow: 10px 10px 20000px 10px #FFFFFF;
            /* Safari, Chrome */
            border-radius: 3px 3px 3px 3px;
            -moz-border-radius: 3px;
            /* Firefox */
            -webkit-border-radius: 3px;
            /* Safari, Chrome */;
        }

        .popup2 {
            display: none;
            background: rgba(93, 173, 226, 1);
            padding: 10px;
            color: white;
            font-weight: bold;
            border: 2px solid #ddd;
            font-size: 1.2em;
            position: fixed;
            top: 20%;
            left: 30%;
            right: 30%;
            z-index: 99999;
            box-shadow: 10px 10px 20000px 10px #FFFFFF;
            /* CSS3 */
            -moz-box-shadow: 10px 10px 20000px 10px #FFFFFF;
            /* Firefox */
            -webkit-box-shadow: 10px 10px 20000px 10px #FFFFFF;
            /* Safari, Chrome */
            border-radius: 3px 3px 3px 3px;
            -moz-border-radius: 3px;
            /* Firefox */
            -webkit-border-radius: 3px;
            /* Safari, Chrome */;
        }

        fieldset {
            border: none;
        }
    </style>
</head>
<body>
    <div id="app">
        @guest
            <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #AC1F2D;font-family: Montserrat, sans-serif;" id="navigation_bar">
                <div class="container-fluid">
                    <div class="navbar-header">

                        <a class="navbar-brand" href="/login">
                            <img src="{{ URL::asset('logos/Logo.png') }}" height="550%" style="margin-top: -20%">
                        </a>

                    </div>

                    <div >
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                    </div>
                </div>
            </nav>
            @else

            <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #AC1F2D;font-family: Montserrat, sans-serif;" id="navigation_bar">
            <div class="container-fluid">
                <div class="navbar-header" style="padding-left: 0%;">

                    @if(Auth::user()->role == 'Student')

                        <a class="navbar-brand" href="/StudentHome">
                            <img src="{{ URL::asset('logos/Logo.png') }}" height="550%" style="margin-top: -20%">
                        </a>

                    @elseif(Auth::user()->role == 'Instructor')

                        <a class="navbar-brand" href="/InstructorHome">
                            <img src="{{ URL::asset('logos/Logo.png') }}" height="550%" style="margin-top: -20%">
                        </a>

                    @else
                        <a class="navbar-brand" href="/home">
                            <img src="{{ URL::asset('logos/Logo.png') }}" height="550%" style="margin-top: -20%">
                        </a>
                    @endif

                </div>

                <div >
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" style="padding-right:5%">
                        @if(Auth::user()->role =='Student' || Auth::user()->role =='Instructor')
                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="fa fa-bell" style="color:white;position: relative;font-size: 1.2em;">
                                </span>
                                    @if(count(auth()->user()->unreadNotifications))
                                        <span class="badge" style="position: absolute; top: 4px;right: 4px;font-size: 1.0em;">
                                    {{count(auth()->user()->unreadNotifications)}}</span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu" role="menu">

                                    <li>
                                        <a href="{{route('markallRead')}}" style="color: blue;">Mark all as read</a>
                                    </li>
                                    @foreach(auth()->user()->unreadNotifications as $notification)
                                        <li style="background-color: #005E63">
                                            @include('layouts.partials.notification.'.snake_case(class_basename($notification->type)))
                                        </li>
                                    @endforeach
                                    @foreach(Auth::user()->readNotifications->slice(0, 5) as $notification)
                                        <li>
                                            @include('layouts.partials.notification.'.snake_case(class_basename($notification->type)))
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                            <li class="dropdown">
                                <a href="#" style="color: white" class="dropdown-toggle nav-inverse" data-toggle="dropdown" role="button" aria-expanded="false">
                                   <b> {{ Auth::user()->firstname }} &nbsp;{{ Auth::user()->lastname}} <span class="caret"></span></b>
                                </a>

                                <ul class="dropdown-menu" role="menu">
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
    </div>
            @yield('content')
            <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up"></i></button>
    </div>
    <div class="form-group footr" style="border: 0px;padding-bottom: 0px; box-shadow: inset 0 -23px 0 #AC1F2D;margin-bottom: 0%">
        <img src="/logos/footer.png" alt="Footer" style="height:180px;width:100%;margin-top: 25%;margin-bottom: 0%">
        <img src="/logos/unmc.png" alt="UNMC logo" style="height: 65px;width: 90px;margin-left: 49%;margin-top: -3.0%;margin-bottom: 0%">
        <div class="col-md-3 col-md-offset-5" style="margin-top: -2.8%;margin-left: 40%;margin-bottom: 0%">
            <a href="#about-us" class="window">About WeChart</a><br>
            <div id="about-us" class="popup">
                <p style="text-align: center; font-size: 120%">About WeChart</p>
                <hr style="border-width: 2px;margin-left: 35%;margin-right: 35%;">
                <p style="text-align: center;">The process of medical documentation is a vital skill for all allied health professionals.  The written record is essential for communication of the patient’s status to ensure proper treatment while minimizing adverse outcomes. Medical errors represent a serious threat to patient safety and have been estimated to add millions to the global healthcare cost.
                    <br>
                    <br>
                    Unfortunately, students are often expected to develop this skill during the clinical exposure phase of their education with minimal guidance.
                    WeChart was developed by the Department of Emergency Medicine at The University of Nebraska Medical Center (UNMC), in collaboration with The University of Nebraska Omaha (UNO). Our goal was to optimize the learning experience for health care students during their clinical internships.</p>
                <br>
            </div>
        </div>
        <div class="col-md-3 col-md-offset-5" style="margin-top: -2.8%;margin-left: 54.5%;margin-bottom: 0%">
            <a href="#contact-us" class="window">Contact Us</a><br>
            <div id="contact-us" class="popup2">
                <p style="text-align: center; font-size: 120%">Contact Us</p>
                <hr style="border-width: 2px;margin-left: 35%;margin-right: 35%;">
                <p style="text-align: center;">Project Lead:<br>
                    Thanh Nguyen<br>
                    402-559-6705<br>
                    Thang.Nguyen@UNMC.edu<br>
                    <br>
                    Licensing Information:<br>
                    Catherine Murari<br>
                    402-559-3265<br>
                    Catherine.Murari@UNMC.edu<br></p>
                <br>
            </div>
        </div>
    </div>
</body>
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
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
        $(document).ready(function() {
            $('a.window').click(function() {

                // Getting the variable's value from a link
                var loginBox = $(this).attr('href');

                //Fade in the Popup and add close button
                $(loginBox).fadeIn(300);

                // Add the mask to body
                $('body').append('<div id="mask"></div>');
                $('#mask').fadeIn(300);

                return false;
            });

            // When clicking on the button close or the mask layer the popup closed
            $('body').on('click', '#mask, #about-us, #contact-us', function() {
                $('#mask , .popup, .popup2').fadeOut(300 , function() {
                    $('#mask').remove();
                });
                return false;
            });
        });
    </script>

</html>
