
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<head>
    <meta charset="utf-8">
    <title>WeChart</title>
    <link rel="stylesheet" href="{{ URL::asset('logos/style.css') }}">
</head>

<body style="background-image: url(logos/background4.jpg)">

<div class="loginBox">
    <h2>Let's Start</h2>
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <p> E-Mail Address </p>
            <div class="col-md-6">
                <input id="email" autocomplete="new-password" type="email" placeholder="Enter Email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                @endif
            </div>
        </div>
        <br>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

            <p> Password </p>

            <div class="col-md-6">
                <input id="password" placeholder="••••••" autocomplete="new-password" type="password" class="form-control" name="password" required>

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
                </a><br>&nbsp;&nbsp;<br>
                <a class="btn btn-link" href="{{ route('register') }}">
                    Register
                </a>
            </div>
        </div>
    </form>
    <img src="{{ URL::asset('logos/WeChart_Logo_JPEG.jpg') }}" class="user">

</div>
</body>
