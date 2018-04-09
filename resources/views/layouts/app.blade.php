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
                <div class="navbar-header" style="padding-left: 5%;">

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
    </div>

    <div>
    <img src="/logos/footer.png" alt="Footer" style="height:250px;width:100%;">
        <img src="/logos/unmc.png" alt="UNMC logo" style="height: 65px;width: 90px;margin-left: 45%;margin-top: -6%">
    </div>
    <div class="form-group footr">
        <div class="col-md-3 col-md-offset-5" style="margin-top: -5.3%;margin-left: 50%">
            <a href="#">About WeChart</a><br>
            <a href="#">Contact us</a>
        </div>
    </div>
    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
</body>
</html>