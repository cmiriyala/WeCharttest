
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WeChart</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>

    body {
        background-repeat: no-repeat;
        background-size: cover;
    }
    img{
        position: fixed;
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
        alignment: center;
        z-index: 10;
        width: 100%; height: 100%;
        opacity: 0.8;
        z-index: 999;
    }

    .login-popup{
        display:none;
        position: absolute;
        width: 300px;
        height: 200px;

        top: 10%;
        left: 10%;
        margin: -100px 0 0 -150px;
        background: #3F80B8;
        padding: 10px;
        border: 2px solid #ddd;
        float: left;
        font-size: 1.2em;

        z-index: 99999;
        box-shadow: 0px 0px 20px #999;
        -moz-box-shadow: 0px 0px 20px #999; /* Firefox */
        -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
        border-radius:3px 3px 3px 3px;
        -moz-border-radius: 3px; /* Firefox */
        -webkit-border-radius: 3px; /* Safari, Chrome */
    }
    fieldset {
        border:none;
    }

</style>
</head>

<body style="background-image: url(logos/Login_Background.jpg); z-index: -1;" >

<nav class="navbar navbar-inverse navbar-static-top" id="navigation_bar"></nav>

<img src="/logos/footer.png" alt="Footer" style="width: 100%; height: 35%;margin-top: 14.5%">
<img src="/logos/unmc.png" alt="UNMC logo" style="width: 5%; height: 8%; left: 47%; top: 96%;">


<div class="loginBox">
    <img src="/logos/login_panel.png" alt="LoginPanel">
    <img src="/logos/Logo.png" style="width: 20%; height: 30%;margin-top: -16%">
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="email" autocomplete="new-password" type="email" placeholder="Enter Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-md-6">
                <input id="password" placeholder="Enter Password" autocomplete="new-password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
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
        <div class="col-md-1 col-md-offset-5" style="margin-top: 98%; margin-left: 120%;">
        <a href="#">About WeChart</a><br>
        <a href="#">Contact us</a>
    </div>
    </div>
</div>

</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('a.login-window').click(function() {

            // Getting the variable's value from a link
            var loginBox = $(this).attr('href');

            //Fade in the Popup and add close button
            $(loginBox).fadeIn(300);

            //Set the center alignment padding + border
            var popMargTop = ($(loginBox).height() + 24) / 2;
            var popMargLeft = ($(loginBox).width() + 24) / 2;

            $(loginBox).css({
                'margin-top' : -popMargTop,
                'margin-left' : -popMargLeft
            });

            // Add the mask to body
            $('body').append('<div id="mask"></div>');
            $('#mask').fadeIn(300);

            return false;
        });

        // When clicking on the button close or the mask layer the popup closed
        $('a.close, #mask').live('click', function() {
            $('#mask , .login-popup').fadeOut(300 , function() {
                $('#mask').remove();
            });
            return false;
        });
    });
</script>
