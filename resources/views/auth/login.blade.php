
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeChart</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>

    body {
        background-size: 1540px 740px;
        background-repeat: no-repeat;
        padding: 0;
        margin: 0 0 -10px;
        overflow: hidden;
    }
    img{
        position: absolute;
        top: 55%;
        left: 50%;
        transform: translate(-50%,-50%);
        width: 80%;
        height: 110%;
        opacity:2;
    }
    input:-webkit-autofill {
        -webkit-box-shadow: 0 0 0px 1000px white inset;
    }
    .logo
    {
        width: 200px;
        height: 80px;
        top: 2%;
        left: 60%;
        border-radius: 0px;
        overflow: hidden;
        position: absolute;
        box-shadow: 5px 5px 80px grey;
    }
    #navigation_bar{
        background-color: #AC1F2D;
    }
    .navbar {
        -webkit-box-shadow: 0 8px 6px -6px #999;
        -moz-box-shadow: 0 8px 6px -6px #999;
        box-shadow:5px 5px 50px 5px black;
        border: 0;
    }
    .loginBox
    {
        position: fixed;
        top: 20%;
        left: 40%;
        padding: 80px 40px;
        box-sizing: border-box;
    }
    h2
    {
        margin: 0;
        padding: 0 0 20px;
        color: white;
        text-align: center;
    }
    .loginBox p
    {
        margin: 0;
        padding: 0;
        font-weight: bold;
        color: #fff;
    }
    .loginBox input
    {
        margin-left: -40px;
        width: 400%;
        margin-bottom: 20px;
        background-color: white;
        color: black;
    }
    .loginBox input[type="email"],
    .loginBox input[type="password"]
    {
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        height: 40px;
        color: black;
        font-size: 16px;
        font-family: sans-serif;
    }
    ::placeholder
    {
        color: rgba(255,255,255,.5);
    }
    .loginBox input[type="submit"]
    {
        margin-left: -100px;
        border: none;
        outline: none;
        width:250%;
        height: 40px;
        color: #000000;
        font-size: 16px;
        background: #F0FFFF;
        cursor: pointer;
        border-radius: 20px;
        -webkit-filter: blur(0.2px);
    }
    .loginBox input[type="submit"]:hover
    {
        background: #5cd65c;
        color: #fff;
        text-shadow: 0px 0px 10px black, 0 0 5px white;
        box-shadow: 0 0 15px white;
        transform: scale(1.1);
        -webkit-transition: transform 0.2s ease-in-out;
    }
    .loginBox a
    {
        margin-left: -120px;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
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

<body style="background-image: url(logos/Login_Background.jpg); z-index: -1; width: 1000%" >

<nav class="navbar navbar-inverse navbar-static-top" id="navigation_bar"></nav>

<img src="/logos/footer.png" alt="Footer" style="width: 100%; height: 35%;margin-top: 14.8%">
<img src="/logos/unmc.png" alt="UNMC logo" style="width: 5%; height: 8%; left: 51%; top: 96%;">


<div class="loginBox">
    <img src="/logos/login_panel.png" alt="LoginPanel" style="width: 1200px; height: 800px;margin-left: 10%" >
    <img src="/logos/Logo.png" style="width: 300px; height: 200px;margin-top: -90%">
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="email" autocomplete="new-password" type="email" placeholder="Enter Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <p style="width: 600%">Details do not match records</p>

                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="password" placeholder="Enter Password" autocomplete="new-password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <p style="width: 600%">Details do not match records</p>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <input id ="password" type="submit" name="" value="Sign In">

                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                    Forgot Your Password?
                </a><br>
                <a class="btn btn-link" href="{{ route('register') }}">
                    Register
                </a>
            </div>
        </div>
    </form>
    <div class="form-group">
        @if ($errors->has('email'))
            <div class="col-md-1 col-md-offset-5" style="margin-left:5%;margin-top:10.6%;position: fixed">
                <a href="#login-box" class="login-window">About WeChart</a><br>
            </div>
            <div class="col-md-1 col-md-offset-5" style="margin-left:18.5%;margin-top:10.6%;position: fixed">
                <a href="#">Contact us</a>
            </div>
        <script>
            setTimeout(function() {
                document.location.reload()
            }, 3000);
        </script>

        @else
            <div class="col-md-1 col-md-offset-5" style="margin-left:5%;margin-top:12%;position: fixed">
                <a href="#aboutus" class="window">About WeChart</a><br>
                <div id="aboutus" class="popup">
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
            </div>
            <div class="col-md-1 col-md-offset-5" style="margin-left:18.5%;margin-top:12%;position: fixed">
                <a href="#login-box" class="window">Contact Us</a><br>
                <div id="login-box" class="popup2">
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
        @endif


    </div>
</div>

</body>

<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert"></script>
<script type="text/javascript">
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
        $('body').on('click','#mask', function() {
            $('#mask , .popup, .popup2').fadeOut(300 , function() {
                $('#mask').remove();
            });
            return false;
        });
    });
</script>
